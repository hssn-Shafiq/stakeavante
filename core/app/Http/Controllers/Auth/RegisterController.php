<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Models\AdminNotification;
use App\Models\Frontend;
use App\Models\GeneralSetting;
use App\Models\User;
use App\Models\UserLogin;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    use RegistersUsers;
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('regStatus')->except('registrationNotAllowed');
        $this->activeTemplate = activeTemplate();
    }
    public function showRegistrationForm(Request $request)
    {
        $treeId = null;
        $sponsorId = null;
        $joining = null;
        $addedBy = null;
        $page_title = "Sign Up";
        $content = Frontend::where('data_keys', 'sign_up.content')->first();
        $info = json_decode(json_encode(getIpInfo()), true);
        $country_code = @implode(',', $info['code']);
          if($request->reg && $request->ref){
            $sponsorId = User::where('username', $request->reg)->first();
            if($sponsorId!=null && $request->ref!=$request->reg ){
                $treeId = User::where('username', $request->ref)
                    ->where('status',1)
                    ->where(function($query) use ($sponsorId){
                    $query->where('level1_parent',$sponsorId->id)
                    ->orWhere('level2_parent',$sponsorId->id)
                    ->orWhere('level3_parent',$sponsorId->id)
                    ->orWhere('level4_parent',$sponsorId->id)
                    ->orWhere('level5_parent',$sponsorId->id)
                    ->orWhere('level6_parent',$sponsorId->id)
                    ->orWhere('level7_parent',$sponsorId->id);
                })->first();
            }else{
              $treeId=$sponsorId;
            }
            if($treeId){
                $parentId=$treeId->id;
                $count =User::where('ref_id',$parentId)->count();
            }
            if (!$sponsorId) {
                $notify[] = ['error', 'No such sponsor available in the system.'];
                return redirect()->route('home')->withNotify($notify);
            }
            if (!$treeId) {
                $notify[] = ['error', 'No such network tree parent  available in the system.'];
                return redirect()->route('home')->withNotify($notify);
            }
            if(@$count >=3){
              $notify[] = ['error', 'Parent tree user limit of 3 exeeds.'];
              return redirect()->route('home')->withNotify($notify);
            }
        $addedBy = "<span class='help-block2'><strong class='custom-green' >You will register  with reference of $sponsorId->firstname $sponsorId->lastname.</strong></span>";
        $joining = "<span class='help-block2'><strong class='custom-green' >You will connected with Tree of $treeId->firstname $treeId->lastname.</strong></span>";
        session()->put('sponsor', $request->reg);
        session()->put('position', $request->ref);
        }else{
        session()->forget('sponsor');
        session()->forget('position');
        }
        return view($this->activeTemplate . 'user.auth.register', compact('page_title','sponsorId','treeId','addedBy','joining', 'content', 'country_code'));
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $general = GeneralSetting::first();
        $agree = 'nullable';
        if ($general->agree_policy) {
            $agree = 'required';
        }
        $sponser='nullable';
        if(session()->get('sponsor') != null){
            $sponser='required|string|max:160';
        }
        $treeUser='nullable';
        if(session()->get('position') != null){
            $treeUser='required|string|max:160';
        }
        $validate = Validator::make($data, [
            'registrant'    => $sponser,
            'referral'      => $treeUser,
            'firstname'     => 'sometimes|required|string|max:60',
            'lastname'      => 'sometimes|required|string|max:60',
            'email'         => 'required|string|email|max:160|unique:users',
            'mobile'        => 'required|string|max:30|unique:users',
            'password'      => 'required|string|min:6|confirmed',
            'captcha'       => 'sometimes|required',
            'country_code'  => 'required',
            'agree' => $agree
        ]);
        return $validate;
    }
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        $general = GeneralSetting::first();
        // In case of referal links
        if($request->registrant && $request->referral){
            $ref_user = User::where('username', $request->referral)->where('status',1)->first();
            if($ref_user){
                $userLimit = User::where('ref_id', $ref_user->id)->count();
                if ($userLimit >=3) {
                    $notify[] = ['error', 'Limit 3 Exceeded'];
                    return back()->withNotify($notify);
                }
            }else{
            $notify[] = ['error', 'Refferal Not found'];
                return back()->withNotify($notify);
            }
        }else{
            $ref_user = User::where('id', 1)->where('status',1)->first();
            if($ref_user){
                $userLimit = User::where('ref_id', $ref_user->id)->count();
                    $request->merge([
                        'registrant' => $ref_user->username,
                    ]);
                if ($userLimit >= 3) {
                    $parentId=$this->generatePairId([$ref_user->id],7,0);
                    $parentUser=null;
                    if($parentId > 0){
                      $parentUser = User::where('id', $parentId)->first();
                      $request->merge([
                        'referral' => $parentUser->username,
                        ]);
                    }else{
                        $notify[] = ['error', 'Critical Error'];
                        return back()->withNotify($notify);
                    }
                }else{
                    $request->merge([
                        'referral' => $ref_user->username,
                        ]);
                }
            }else{
            $notify[] = ['error', 'Refferal Not found'];
                return back()->withNotify($notify);
            }
        }
        if ($general->secure_password) {
            $notify = $this->strongPassCheck($request->password);
            if ($notify) {
                return back()->withNotify($notify)->withInput($request->all());
            }
        }
        $exist = User::where('mobile', $request->country_code . $request->mobile)->first();
        if ($exist) {
            $notify[] = ['error', 'Mobile number already exist'];
            return back()->withNotify($notify)->withInput();
        }
        $emailCheck = User::where('email', $request->email)->first();
        if ($emailCheck) {
            $notify[] = ['error', 'Email already exists.'];
            return back()->withNotify($notify);
        }
        if (isset($request->captcha)) {
            if (!captchaVerify($request->captcha, $request->captcha_secret)) {
                $notify[] = ['error', "Invalid Captcha"];
                return back()->withNotify($notify)->withInput();
            }
        }
        event(new Registered($user = $this->create($request->all())));
        $this->guard()->login($user);
        return redirect()->route('user.home');
    }
    //Auto adjust user
    private function generatePairId($ids,$totalLevel,$level){
        foreach($ids as $id){
            $totalReferals = User::where('ref_id', $id)->get();
            if(count($totalReferals) < 3){
                return $id;
            }else{
                if($totalLevel > $level){
                    foreach($totalReferals as $child){
                       $totalSubReferals = User::where('ref_id', $child->id)->get();
                       if(count($totalSubReferals) < 3){
                        return $child->id;
                       }else{
                        $tempArrayNew[] = $child->id;
                       }
                    }
                }
            }
        }
        if (!empty($tempArrayNew) && $level < $totalLevel) {
            $level = $level + 1;
            return $this->generatePairId($tempArrayNew, $totalLevel, $level);
        }
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $gnl = GeneralSetting::first();
        $regCheck = User::where('username', $data['registrant'])->first();
        if($regCheck!=null){
            if($data['registrant']==$data['referral']){
            $userCheck = User::where('username',$data['referral'])
                        ->where('status',1)
                        ->first();
            }else{
            $userCheck = User::where('username', $data['referral'])
                        ->where('status',1)
                        ->where(function($query) use ($regCheck){
                        $query->where('level1_parent',$regCheck->id)
                        ->orWhere('level2_parent',$regCheck->id)
                        ->orWhere('level3_parent',$regCheck->id)
                        ->orWhere('level4_parent',$regCheck->id)
                        ->orWhere('level5_parent',$regCheck->id)
                        ->orWhere('level6_parent',$regCheck->id)
                        ->orWhere('level7_parent',$regCheck->id);
                    })->first();
            }
        }else{
          $userCheck=null;
        }
        $level1 = null;
        $level2 = null;
        $level3 = null;
        $level4 = null;
        $level5 = null;
        $level6 = null;
        $level7 = null;
        if($userCheck!=null){
            $level1 = $userCheck->id;
            if($level1!=null){
                $level2 = $this->getLevelid($level1);
                if($level2!=null){
                    $level3 = $this->getLevelid($level2);
                    if($level3!=null){
                        $level4 = $this->getLevelid($level3);
                        if($level4!=null){
                            $level5 = $this->getLevelid($level4);
                            if($level5!=null){
                            $level6 = $this->getLevelid($level5);
                            if($level6!=null){
                            $level7 = $this->getLevelid($level6);
                                }
                            }
                        }
                    }
                }
            }
        }
        //User Create
        $user = new User();
        if($regCheck!=null){
        $user->added_by     = $regCheck->id;
        }else{
        $user->added_by     = 0;
        }
        if($userCheck!=null){
        $user->ref_id       = $userCheck->id;
        }else{
        $user->ref_id       = 0;
        }
        $user->level1_parent= $level1;
        $user->level2_parent= $level2;
        $user->level3_parent= $level3;
        $user->level4_parent= $level4;
        $user->level5_parent= $level5;
        $user->level6_parent= $level6;
        $user->level7_parent= $level7;
        $user->user_from    = 'web_app';
        $user->plan_type    =0;
        $user->firstname    = isset($data['firstname']) ? $data['firstname'] : null;
        $user->lastname     = isset($data['lastname']) ? $data['lastname'] : null;
        $user->email        = strtolower(trim($data['email']));
        $user->password     = Hash::make($data['password']);
        $user->mobile       = $data['country_code'] . $data['mobile'];
        $user->address      = [
            'address' => '',
            'state' => '',
            'zip' => '',
            'country' => isset($data['country']) ? $data['country'] : null,
            'city' => ''
        ];
        $user->status = 1;
        $user->ev = $gnl->ev ? 0 : 1;
        $user->sv = $gnl->sv ? 0 : 1;
        $user->ts = 0;
        $user->tv = 1;
        $user->save();
        $regCheck->free_coins += $gnl->coin_commission?$gnl->coin_commission:2;
        $regCheck->save();
        //create user ID
        if($user->id){
            $userID ='TN' . str_pad($user->id ?? 1 + 1, 6, "0", STR_PAD_LEFT);
            \DB::table('users')->where('id',$user->id)->update(array('username' => $userID));
        }
        $adminNotification = new AdminNotification();
        $adminNotification->user_id = $user->id;
        $adminNotification->title = 'New member registered';
        $adminNotification->click_url = route('admin.users.detail', $user->id);
        $adminNotification->save();
        //Login Log Create
        $ip = $_SERVER["REMOTE_ADDR"];
        $exist = UserLogin::where('user_ip', $ip)->first();
        $userLogin = new UserLogin();
        //Check exist or not
        if ($exist) {
            $userLogin->longitude =  $exist->longitude;
            $userLogin->latitude =  $exist->latitude;
            $userLogin->location =  $exist->location;
            $userLogin->country_code = $exist->country_code;
            $userLogin->country =  $exist->country;
        } else {
            $info = json_decode(json_encode(getIpInfo()), true);
            $userLogin->longitude =  @implode(',', $info['long']);
            $userLogin->latitude =  @implode(',', $info['lat']);
            $userLogin->location =  @implode(',', $info['city']) . (" - " . @implode(',', $info['area']) . "- ") . @implode(',', $info['country']) . (" - " . @implode(',', $info['code']) . " ");
            $userLogin->country_code = @implode(',', $info['code']);
            $userLogin->country =  @implode(',', $info['country']);
        }
        $userAgent = osBrowser();
        $userLogin->user_id = $user->id;
        $userLogin->user_ip =  $ip;
        $userLogin->browser = @$userAgent['browser'];
        $userLogin->os = @$userAgent['os_platform'];
        $userLogin->save();
        return $user;
    }
    protected function getLevelid($ref_id){
        $user = User::where('id', $ref_id)->first();
        return ($user->ref_id!=0?$user->ref_id:null);
    }
    protected function strongPassCheck($password)
    {
        $password = $password;
        $capital = '/[ABCDEFGHIJKLMNOPQRSTUVWXYZ]/';
        $capital = preg_match($capital, $password);
        $notify = null;
        if (!$capital) {
            $notify[] = ['error', 'Minimum 1 capital word is required'];
        }
        $number = '/[123456790]/';
        $number = preg_match($number, $password);
        if (!$number) {
            $notify[] = ['error', 'Minimum 1 number is required'];
        }
        $special = '/[`!@#$%^&*()_+\-=\[\]{};:"\\|,.<>\/?~\']/';
        $special = preg_match($special, $password);
        if (!$special) {
            $notify[] = ['error', 'Minimum 1 special character is required'];
        }
        return $notify;
    }
}