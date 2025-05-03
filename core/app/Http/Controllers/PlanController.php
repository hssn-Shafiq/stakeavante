<?php

namespace App\Http\Controllers;

use App\Models\GeneralSetting;
use App\Models\Plan;
use App\Models\Membership;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PlanController extends Controller
{

    public function __construct()
    {
        $this->activeTemplate = activeTemplate();
    }
    function planIndex()
    {
        $data['page_title'] = "Plans";
        $data['plans'] = Plan::where('status',1)->where('is_default',1)->get();
        $data['memberships'] = Membership::all();
        return view($this->activeTemplate . '.user.plan', $data);
    }
    function planStore(Request $request)
    {
        $this->validate($request, ['plan_id' => 'required|integer']);
        $plan = Plan::where('id', $request->plan_id)->where('status', 1)->where('is_default', 1)->firstOrFail();
        $membership = Membership::where('id',$request->membership)->firstOrFail();
        $gnl = GeneralSetting::first();

        $user = User::find(Auth::id());
        if ($user->balance < $membership->price) {
            $notify[] = ['error', 'Insufficient Balance'];
            return back()->withNotify($notify);
        }
        if ($plan->min_price > $membership->price) {
            $notify[] = ['error', 'Minimum '.$plan->min_price.$gnl->cur_text.' amount is required'];
            return back()->withNotify($notify);
        }

            $oldPlan = $user->plan_id;
            $user->plan_id = $plan->id;
            if($request->mplan==1){
                $expiry =Carbon::now()->addMonth(24);
            }
            $user->plan_type = $request->mplan;
            $user->plan_expiry = $expiry;
            $user->membership_id = $membership->id;
            $user->balance -= $membership->price;
            $user->total_invest += $membership->price;
            $user->save();

            $trx = $user->transactions()->create([
                'amount' => $membership->price,
                'trx_type' => '-',
                'details' => 'Purchased ' . $plan->name.' plan with membership '.$membership->name,
                'remark' => 'purchased_plan',
                'trx' => getTrx(),
                'post_balance' => getAmount($user->balance),
            ]);

            notify($user, 'plan_purchased', [
                'plan' => $plan->name,
                'amount' => getAmount($membership->price),
                'currency' => $gnl->cur_text,
                'trx' => $trx->trx,
                'post_balance' => getAmount($user->balance) . ' ' . $gnl->cur_text,
            ]);
            usleep(50000);
            //for referral comission
            if($user->added_by > 0){
                $amount = ceil($membership->price*$plan->ref_com/100);
                treeComission($user->id,$amount,'plan_purchase');
            }
            usleep(50000);
            //for total sale
                //Level 1
                if($user->level1_parent > 0){
                treeSale($user->id,$membership->price,1,'plan_purchase');
                }
            usleep(50000);
                //Level 2
                if($user->level2_parent > 0){
                treeSale($user->id,$membership->price,2,'plan_purchase');
                }
            usleep(50000);
                //Level 3
                if($user->level3_parent > 0){
                treeSale($user->id,$membership->price,3,'plan_purchase');
                }
            usleep(50000);
                //Level 4
                if($user->level4_parent > 0){
                treeSale($user->id,$membership->price,4,'plan_purchase');
                }
            usleep(50000);
                //Level 5
                if($user->level5_parent > 0){
                treeSale($user->id,$membership->price,5,'plan_purchase');
                }
            usleep(50000);
                //Level 6
                if($user->level6_parent > 0){
                treeSale($user->id,$membership->price,6,'plan_purchase');
                }
            usleep(50000);
                //Level 7
                if($user->level7_parent > 0){
                treeSale($user->id,$membership->price,7,'plan_purchase');
                }
            $notify[] = ['success', 'Purchased ' . $plan->name . ' Successfully'];
            return redirect()->route('user.home')->withNotify($notify);

    }
    function planMore(Request $request)
    {
        $this->validate($request, ['plan_id' => 'required|integer']);
        $plan = Plan::where('id', $request->plan_id)->where('status', 1)->where('is_default', 1)->firstOrFail();

        $gnl = GeneralSetting::first();
        $user = User::find(Auth::id());
        if ($user->balance < $request->amount) {
            $notify[] = ['error', 'Insufficient Balance'];
            return back()->withNotify($notify);
        }
        if ($request->amount < 5) {
            $notify[] = ['error', 'Minimum 5 '.$gnl->cur_text.' amount is required'];
            return back()->withNotify($notify);
        }
        if($request->mplan){
            if($request->mplan==1){
                $expiry =Carbon::now()->addMonth(24);
                $user->plan_type = $request->mplan;
                $user->plan_expiry = $expiry;
            }
        }
            $user_invest = $user->total_invest+$request->amount;
            switch($user_invest){
                case($user_invest >=70):
                $user->membership_id = 7;
                break;
                case($user_invest >=60):
                $user->membership_id = 6;
                break;
                case($user_invest >=50):
                $user->membership_id = 5;
                break;
                case($user_invest >=40):
                $user->membership_id = 4;
                break;
                case($user_invest >=30):
                $user->membership_id = 3;
                break;
                case($user_invest >=20):
                $user->membership_id = 2;
                break;
                case($user_invest >=5):
                $user->membership_id = 1;
                break;
            }
            $user->balance -= $request->amount;
            $user->total_invest += $request->amount;
            $user->save();
            $trx = $user->transactions()->create([
                'amount' => $request->amount,
                'trx_type' => '-',
                'details' => 'Invested'.$request->amount.$gnl->cur_text,
                'remark' => 'purchased_plan',
                'trx' => getTrx(),
                'post_balance' => getAmount($user->balance),
            ]);

            /*notify($user, 'plan_purchased', [
                'plan' => 'invested in '.$plan->name,
                'amount' => getAmount($request->amount),
                'currency' => $gnl->cur_text,
                'trx' => $trx->trx,
                'post_balance' => getAmount($user->balance) . ' ' . $gnl->cur_text,
            ]);*/
            usleep(50000);
            //for referral comission
            if($user->added_by > 0){
                $amount = ceil($request->amount*$plan->ref_com/100);
                treeComission($user->id,$amount);
            }
            //for total sale
            if($user->plan_type==1){
                usleep(50000);
                //Level 1
                if($user->level1_parent > 0){
                treeSale($user->id,$request->amount,1);
                }
                usleep(50000);
                //Level 2
                if($user->level2_parent > 0){
                treeSale($user->id,$request->amount,2);
                }
                usleep(50000);
                //Level 3
                if($user->level3_parent > 0){
                treeSale($user->id,$request->amount,3);
                }
                usleep(50000);
                //Level 4
                if($user->level4_parent > 0){
                treeSale($user->id,$request->amount,4);
                }
                usleep(50000);
                //Level 5
                if($user->level5_parent > 0){
                treeSale($user->id,$request->amount,5);
                }
                usleep(50000);
                //Level 6
                if($user->level6_parent > 0){
                treeSale($user->id,$request->amount,6);
                }
                usleep(50000);
                //Level 7
                if($user->level7_parent > 0){
                treeSale($user->id,$request->amount,7);
                }

            }
            $notify[] = ['success', 'Invested ' . $plan->name . ' Successfully'];
            return redirect()->route('user.home')->withNotify($notify);

    }
    public function binarySummery()
    {
        $data['page_title'] = "Tree Summery";
        $users = User::where('level1_parent', auth()->id())->orWhere('level2_parent', auth()->id())->orWhere('level3_parent', auth()->id())->orWhere('level4_parent', auth()->id())->orWhere('level5_parent', auth()->id())->orWhere('level6_parent', auth()->id())->orWhere('level7_parent', auth()->id())->get();
        $data['users'] = $users->paginate(getPaginate());
        return view($this->activeTemplate . '.user.binarySummery', $data);
    }
    public function myRefLog()
    {
        $data['page_title'] = "My Referral";
        $data['empty_message'] = 'No data found';
        $data['logs'] = User::where('ref_id', auth()->id())->latest()->paginate(config('constants.table.default'));
        return view($this->activeTemplate . '.user.myRef', $data);
    }

    public function myTree()
    {
        $data['tree'] = showTreePage(Auth::id());
        $data['page_title'] = "My Tree";
        return view($this->activeTemplate . 'user.myTree', $data);
    }


    public function otherTree(Request $request, $username = null)
    {
        if ($request->username) {
            $user = User::where('username', $request->username)->first();
        } else {
            $user = User::where('username', $username)->first();
        }
        if ($user && treeAuth($user->id, auth()->id(),'user')==true) {
            $data['tree'] = showTreePage($user->id);
            $data['page_title'] = "Tree of " . $user->fullname;
            return view($this->activeTemplate . 'user.myTree', $data);
        }

        $notify[] = ['error', 'Tree Not Found or You do not have Permission to view that!!'];
        return redirect()->route('user.my.tree')->withNotify($notify);

    }

}
