<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\Plan;
use App\Models\Membership;
use App\Models\Reward;
use Illuminate\Http\Request;

class ManagePlanController extends Controller
{
    public function plan()
    {
        $page_title = 'Avante Plans';
        $empty_message = 'No Plan found';
        $plans = Plan::paginate(getPaginate());;
        return view('admin.plan.index', compact('page_title', 'plans', 'empty_message'));
    }

    public function planStore(Request $request)
    {
        $this->validate($request, [
            'name'              => 'required',
            'minprice'             => 'required|numeric|min:0',
            'maxprice'                => 'required|numeric|min:0',
            'ref_com'           => 'required|numeric|min:0',
            'profit'          => 'required|numeric|min:0',
        ]);
        $plan = new Plan();
        $plan->name             = $request->name;
        $plan->min_price        = $request->minprice;
        $plan->max_price        = $request->maxprice;
        $plan->ref_com       = $request->ref_com;
        $plan->profit           = $request->profit;
        $plan->is_default       = $request->default?1:0;
        $plan->status           = $request->status?1:0;
        $plan->save();
        if($request->default){
            \DB::table('plans')->where('id', '<>', $plan->id)->update(array('is_default' => 0));
        }
        $notify[] = ['success', 'New Plan created successfully'];
        return back()->withNotify($notify);
    }
    public function planUpdate(Request $request)
    {
        $this->validate($request, [
            'name'              => 'required',
            'minprice'             => 'required|numeric|min:0',
            'maxprice'                => 'required|numeric|min:0',
            'ref_com'           => 'required|numeric|min:0',
            'profit'          => 'required|numeric|min:0',
        ]);
        $plan                   = Plan::find($request->id);
        $plan->name             = $request->name;
        $plan->min_price        = $request->minprice;
        $plan->max_price        = $request->maxprice;
        $plan->ref_com       = $request->ref_com;
        $plan->profit           = $request->profit;
        $plan->is_default       = $request->default?1:0;
        $plan->status           = $request->status?1:0;
        $plan->save();
        if($request->default){
            \DB::table('plans')->where('id', '<>', $request->id)->update(array('is_default' => 0));
        }

        $notify[] = ['success', 'Plan Updated Successfully.'];
        return back()->withNotify($notify);
    }
    public function membership()
    {
        $page_title = 'Avante Membership';
        $empty_message = 'No Membership found';
        $memberships = Membership::paginate(getPaginate());
        return view('admin.plan.membership', compact('page_title', 'memberships', 'empty_message'));
    }
    public function membershipUpdate(Request $request)
    {
        $this->validate($request, [
            'name'              => 'required',
            'price'             => 'required|numeric|min:0',
            'level'          => 'required|numeric|min:0',
        ]);

        $plan               = Membership::find($request->id);
        $plan->name         = $request->name;
        $plan->price        = $request->price;
        $plan->level        = $request->level;
        $plan->save();
        $notify[] = ['success', 'Membership Updated Successfully.'];
        return back()->withNotify($notify);
    }
    public function rewards()
    {
        $page_title = 'Avante Rewards';
        $empty_message = 'No rewards found';
        $rewards = Reward::paginate(getPaginate());
        return view('admin.plan.rewards', compact('page_title', 'rewards', 'empty_message'));
    }
    public function rewardsUpdate(Request $request)
    {
        $this->validate($request, [
            'name'              => 'required',
            'price'             => 'required|numeric|min:0',
        ]);

        $reward               = Reward::find($request->id);
        $reward->name         = $request->name;
        $reward->price        = $request->price;
        $reward->save();
        $notify[] = ['success', 'Reward Updated Successfully.'];
        return back()->withNotify($notify);
    }

}
