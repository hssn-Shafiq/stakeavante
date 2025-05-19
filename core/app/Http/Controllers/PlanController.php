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

    public function planIndex()
    {
        $data['page_title'] = "Plans";
        $data['plans'] = Plan::where('status', 1)->where('is_default', 1)->get();
        $data['memberships'] = Membership::all();
        return view($this->activeTemplate . '.user.plan', $data);
    }

    public function planStore(Request $request)
    {
        $this->validate($request, [
            'plan_id' => 'required|integer',
            'mplan' => 'required|in:1,2,3,24',
            'membership' => 'required|exists:memberships,id',
        ]);

        $plan = Plan::where('id', $request->plan_id)->where('status', 1)->where('is_default', 1)->firstOrFail();
        $membership = Membership::where('id', $request->membership)->firstOrFail();
        $gnl = GeneralSetting::first();

        $user = User::find(Auth::id());
        if ($user->balance < $membership->price) {
            $notify[] = ['error', 'Insufficient Balance'];
            return back()->withNotify($notify);
        }
        if ($plan->min_price > $membership->price) {
            $notify[] = ['error', 'Minimum ' . $plan->min_price . $gnl->cur_text . ' amount is required'];
            return back()->withNotify($notify);
        }

        $expiry = match ($request->mplan) {
            '1' => Carbon::now()->addMonth(1),
            '2' => Carbon::now()->addMonths(2),
            '3' => Carbon::now()->addMonths(3),
            '24' => Carbon::now()->addMonths(24),
            default => null,
        };

        $oldPlan = $user->plan_id;
        $user->plan_id = $plan->id;
        $user->plan_type = $request->mplan;
        $user->plan_expiry = $expiry;
        $user->membership_id = $membership->id;
        $user->balance -= $membership->price;
        $user->total_invest += $membership->price;
        $user->save();

        $trx = $user->transactions()->create([
            'amount' => $membership->price,
            'trx_type' => '-',
            'details' => 'Purchased ' . $plan->name . ' plan with membership ' . $membership->name,
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

        // Direct referral commission (credit the parent)
        if ($user->level1_parent) {
            $amount = ceil($membership->price * $plan->ref_com / 100);
            treeComission($user->id, $amount, 'plan_purchase', $user->level1_parent);
        }

        // Indirect referral commission (grandparent)
        if ($user->level2_parent) {
            $amount = ceil($membership->price * $plan->indir_com / 100);
            treeComission($user->id, $amount, 'plan_purchase_indirect', $user->level2_parent);
        }

        // Total sale for levels 1 to 7
        for ($level = 1; $level <= 7; $level++) {
            if ($user->{"level{$level}_parent"} > 0) {
                treeSale($user->id, $membership->price, $level, 'plan_purchase');
            }
        }

        $notify[] = ['success', 'Purchased ' . $plan->name . ' Successfully'];
        return redirect()->route('user.home')->withNotify($notify);
    }

    public function planMore(Request $request)
    {
        $this->validate($request, [
            'plan_id' => 'required|integer',
            'amount' => 'required|numeric|min:5',
            'mplan' => 'nullable|in:1,2,3,24',
        ]);

        $plan = Plan::where('id', $request->plan_id)->where('status', 1)->where('is_default', 1)->firstOrFail();
        $gnl = GeneralSetting::first();
        $user = User::find(Auth::id());

        if ($user->balance < $request->amount) {
            $notify[] = ['error', 'Insufficient Balance'];
            return back()->withNotify($notify);
        }
        if ($request->amount < 5) {
            $notify[] = ['error', 'Minimum 5 ' . $gnl->cur_text . ' amount is required'];
            return back()->withNotify($notify);
        }

        if ($request->mplan) {
            $expiry = match ($request->mplan) {
                '1' => Carbon::now()->addMonth(1),
                '2' => Carbon::now()->addMonths(2),
                '3' => Carbon::now()->addMonths(3),
                '24' => Carbon::now()->addMonths(24),
                default => null,
            };
            $user->plan_type = $request->mplan;
            $user->plan_expiry = $expiry;
        }

        $user_invest = $user->total_invest + $request->amount;
        switch (true) {
            case ($user_invest >= 70):
                $user->membership_id = 7;
                break;
            case ($user_invest >= 60):
                $user->membership_id = 6;
                break;
            case ($user_invest >= 50):
                $user->membership_id = 5;
                break;
            case ($user_invest >= 40):
                $user->membership_id = 4;
                break;
            case ($user_invest >= 30):
                $user->membership_id = 3;
                break;
            case ($user_invest >= 20):
                $user->membership_id = 2;
                break;
            case ($user_invest >= 5):
                $user->membership_id = 1;
                break;
        }

        $user->balance -= $request->amount;
        $user->total_invest += $request->amount;
        $user->save();

        $trx = $user->transactions()->create([
            'amount' => $request->amount,
            'trx_type' => '-',
            'details' => 'Invested ' . $request->amount . $gnl->cur_text,
            'remark' => 'purchased_plan',
            'trx' => getTrx(),
            'post_balance' => getAmount($user->balance),
        ]);

        notify($user, 'plan_purchased', [
            'plan' => 'invested in ' . $plan->name,
            'amount' => getAmount($request->amount),
            'currency' => $gnl->cur_text,
            'trx' => $trx->trx,
            'post_balance' => getAmount($user->balance) . ' ' . $gnl->cur_text,
        ]);

        // Direct referral commission (credit the parent)
        if ($user->level1_parent) {
            $amount = ceil($request->amount * $plan->ref_com / 100);
            treeComission($user->id, $amount, 'plan_purchase', $user->level1_parent);
        }

        // Indirect referral commission (grandparent)
        if ($user->level2_parent) {
            $amount = ceil($request->amount * $plan->indir_com / 100);
            treeComission($user->id, $amount, 'plan_purchase_indirect', $user->level2_parent);
        }

        // Total sale for levels 1 to 7
        if ($user->plan_type) {
            for ($level = 1; $level <= 7; $level++) {
                if ($user->{"level{$level}_parent"} > 0) {
                    treeSale($user->id, $request->amount, $level);
                }
            }
        }

        $notify[] = ['success', 'Invested ' . $plan->name . ' Successfully'];
        return redirect()->route('user.home')->withNotify($notify);
    }

    public function indirectCommissionReport()
    {
        $data['page_title'] = "Indirect Commission Report";
        $data['empty_message'] = 'No indirect commission found';
        $data['logs'] = Transaction::where('user_id', auth()->id())
            ->where('remark', 'plan_purchase_indirect')
            ->latest()
            ->paginate(config('constants.table.default'));
        return view($this->activeTemplate . '.user.reports.indir_com', $data);
    }

    public function binarySummery()
    {
        $data['page_title'] = "Tree Summery";
        $users = User::where('level1_parent', auth()->id())
            ->orWhere('level2_parent', auth()->id())
            ->orWhere('level3_parent', auth()->id())
            ->orWhere('level4_parent', auth()->id())
            ->orWhere('level5_parent', auth()->id())
            ->orWhere('level6_parent', auth()->id())
            ->orWhere('level7_parent', auth()->id())
            ->get();
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
        if ($user && treeAuth($user->id, auth()->id(), 'user') == true) {
            $data['tree'] = showTreePage($user->id);
            $data['page_title'] = "Tree of " . $user->fullname;
            return view($this->activeTemplate . 'user.myTree', $data);
        }

        $notify[] = ['error', 'Tree Not Found or You do not have Permission to view that!!'];
        return redirect()->route('user.my.tree')->withNotify($notify);
    }
}

if (!function_exists('treeComission')) {
    function treeComission($userId, $amount, $remark = 'plan_purchase', $recipientId = null)
    {
        $recipient = User::find($recipientId ?: $userId);
        if ($recipient) {
            if ($remark === 'plan_purchase_indirect') {
                $recipient->total_indir_com += $amount;
            } else {
                $recipient->total_binary_com += $amount;
            }
            $recipient->balance += $amount;
            $recipient->save();

            $recipient->transactions()->create([
                'amount' => $amount,
                'trx_type' => '+',
                'details' => 'Commission for ' . $remark,
                'remark' => $remark,
                'trx' => getTrx(),
                'post_balance' => getAmount($recipient->balance),
            ]);
        }
    }
}
