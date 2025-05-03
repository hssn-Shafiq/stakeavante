<?php

namespace App\Http\Controllers;

use App\Models\AdminNotification;
use App\Models\Frontend;
use App\Models\Page;
use App\Models\Menu;
use App\Models\SupportAttachment;
use App\Models\SupportMessage;
use App\Models\SupportTicket;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;


class SiteController extends Controller
{
    public function __construct(){
        $this->activeTemplate = activeTemplate();
    }

    public function CheckUsername(Request $request)
    {
        $reg_user = User::where('username', $request->reg_id)->where('plan_id','!=',0)->where('status',1)->first();
        if ($reg_user == '') {
            return response()->json(['field'=>1,'success' => false, 'msg' => "<span class='help-block'><strong class='text-danger'>Referal user ID not found</strong></span>"]);
        }else{
        $ref_user = User::where('username', $request->ref_id)
            ->where('plan_id','!=',0)
            ->where('status',1)
            ->where(function($query) use ($reg_user){
                $query->where('level1_parent',$reg_user->id)
                ->orWhere('level2_parent',$reg_user->id)
                ->orWhere('level3_parent',$reg_user->id)
                ->orWhere('level4_parent',$reg_user->id)
                ->orWhere('level5_parent',$reg_user->id)
                ->orWhere('level6_parent',$reg_user->id)
                ->orWhere('level7_parent',$reg_user->id);
                })->first();
            if($ref_user=='' && $request->reg_id!=$request->ref_id){
                return response()->json(['field'=>2,'success' => false, 'msg' => "<span class='help-block'><strong class='text-danger'>Network tree user ID not found</strong></span>"]);
            }else{
                if($ref_user=='' && $request->reg_id==$request->ref_id){
                $total_child = User::where('ref_id',$reg_user->id)->count();
                }else{
                $total_child = User::where('ref_id',$ref_user->id)->count();
                }
                if($total_child < 3){
                 if($request->reg_id!=$request->ref_id){
                    if(isUserExistsLevel($ref_user->id,$reg_user->id)==true){
                    return response()->json(['field'=>1,'success' => true, 'msg' => "<span class='help-block'><strong class='text-success'>User ID  matched</strong></span>"]);
                    }else{
                        return response()->json(['field'=>1,'success' => true, 'msg' => "<span class='help-block'><strong class='text-danger'>Referral User level are locked.</strong></span>"]);
                    }
                 }else{
                    return response()->json(['field'=>1,'success' => true, 'msg' => "<span class='help-block'><strong class='text-success'>User ID  matched</strong></span>"]);
                 }
                }else{
                   return response()->json(['field'=>2,'success' => false, 'msg' => "<span class='help-block'><strong class='text-danger'>Tree limit exceeded.</strong></span>"]);
                }
            }

        }
    }
    public function index(){
        $count = Page::where('tempname',$this->activeTemplate)->where('slug','home')->count();
        if($count == 0){
            $page = new Page();
            $page->tempname = $this->activeTemplate;
            $page->name = 'HOME';
            $page->slug = 'home';
            $page->save();
        }

        $data['page_title'] = 'Home';
        $data['sections'] = Page::where('tempname',$this->activeTemplate)->where('slug','home')->firstOrFail();
        return view($this->activeTemplate . 'home', $data);
    }
    public function pages($slug)
    {
        $page = Page::where('tempname',$this->activeTemplate)->where('slug',$slug)->firstOrFail();
        $data['page_title'] = $page->name;
        $data['sections'] = $page;
        return view($this->activeTemplate . 'pages', $data);
    }


    public function contact()
    {
        $data['page_title'] = "Contact Us";
        $data['contact'] = Frontend::where('data_keys', 'contact_us.content')->first();
        $data['sections'] = Page::where('tempname',$this->activeTemplate)->where('slug','contact')->firstOrFail();
        return view($this->activeTemplate . 'contact', $data);
    }
    public function policyDetails($slug,$id)
    {
        $policyPage = Frontend::where('data_keys','policy_pages.element')->where('id',$id)->firstOrFail();
        $data['page_title'] = $policyPage->data_values->title;
        $data['terms'] = $policyPage;
        return view($this->activeTemplate . 'terms', $data);
    }
    public function contactSubmit(Request $request)
    {
        $ticket = new SupportTicket();
        $message = new SupportMessage();

        $imgs = $request->file('attachments');
        $allowedExts = array('jpg', 'png', 'jpeg', 'pdf');

        $this->validate($request, [
            'attachments' => [
                'sometimes',
                'max:4096',
                function ($attribute, $value, $fail) use ($imgs, $allowedExts) {
                    foreach ($imgs as $img) {
                        $ext = strtolower($img->getClientOriginalExtension());
                        if (($img->getSize() / 1000000) > 2) {
                            return $fail("Images MAX  2MB ALLOW!");
                        }
                        if (!in_array($ext, $allowedExts)) {
                            return $fail("Only png, jpg, jpeg, pdf images are allowed");
                        }
                    }
                    if (count($imgs) > 5) {
                        return $fail("Maximum 5 images can be uploaded");
                    }
                },
            ],
            'name' => 'required|max:191',
            'email' => 'required|max:191',
            'subject' => 'required|max:100',
            'message' => 'required',
        ]);


        $random = getNumber();

        $ticket->user_id = auth()->id();
        $ticket->name = $request->name;
        $ticket->email = $request->email;


        $ticket->ticket = $random;
        $ticket->subject = $request->subject;
        $ticket->last_reply = Carbon::now();
        $ticket->status = 0;
        $ticket->save();

        $adminNotification = new AdminNotification();
        $adminNotification->user_id = auth()->id() ? auth()->id() : 0;
        $adminNotification->title = 'New support ticket has opened';
        $adminNotification->click_url = route('admin.ticket.view',$ticket->id);
        $adminNotification->save();

        $message->supportticket_id = $ticket->id;
        $message->message = $request->message;
        $message->save();

        $path = imagePath()['ticket']['path'];

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $image) {
                try {
                    $attachment = new SupportAttachment();
                    $attachment->support_message_id = $message->id;
                    $attachment->image = uploadImage($image, $path);
                    $attachment->save();

                } catch (\Exception $exp) {
                    $notify[] = ['error', 'Could not upload your ' . $image];
                    return back()->withNotify($notify)->withInput();
                }

            }
        }
        $notify[] = ['success', 'ticket created successfully!'];

        return redirect()->route('ticket.view', [$ticket->ticket])->withNotify($notify);
    }
    public function placeholderImage($size = null){
        if ($size != 'undefined') {
            $size = $size;
            $imgWidth = explode('x',$size)[0];
            $imgHeight = explode('x',$size)[1];
            $text = $imgWidth . '×' . $imgHeight;
        }else{
            $imgWidth = 150;
            $imgHeight = 150;
            $text = 'Undefined Size';
        }
        $fontFile = realpath('assets/font') . DIRECTORY_SEPARATOR . 'RobotoMono-Regular.ttf';
        $fontSize = round(($imgWidth - 50) / 8);
        if ($fontSize <= 9) {
            $fontSize = 9;
        }
        if($imgHeight < 100 && $fontSize > 30){
            $fontSize = 30;
        }

        $image     = imagecreatetruecolor($imgWidth, $imgHeight);
        $colorFill = imagecolorallocate($image, 100, 100, 100);
        $bgFill    = imagecolorallocate($image, 175, 175, 175);
        imagefill($image, 0, 0, $bgFill);
        $textBox = imagettfbbox($fontSize, 0, $fontFile, $text);
        $textWidth  = abs($textBox[4] - $textBox[0]);
        $textHeight = abs($textBox[5] - $textBox[1]);
        $textX      = ($imgWidth - $textWidth) / 2;
        $textY      = ($imgHeight + $textHeight) / 2;
        header('Content-Type: image/jpeg');
        imagettftext($image, $fontSize, 0, $textX, $textY, $colorFill, $fontFile, $text);
        imagejpeg($image);
        imagedestroy($image);
    }
}
