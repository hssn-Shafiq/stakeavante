<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Withdrawal;
use App\Models\WithdrawMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserReportController extends Controller
{

    public function __construct()
    {
        $this->activeTemplate = activeTemplate();
        $this->userModel = new User();
    }
    public function myAchievments()
    {
        $data['page_title'] = "Achievments details";
        $id = auth()->id();
        $data['users']= $this->userModel->getTreeUsers()->where('id',$id)->first();
        $data['empty_message'] = 'No data found';
        return view($this->activeTemplate . '.user.achievments', $data);
    }
    public function bvlog()
    {
        $data['page_title'] = "Reward details";
        $data['transactions'] = Transaction::where('user_id', auth()->id())->where('remark', 'bonus_commission')->orderBy('id', 'DESC')->paginate(config('constants.table.default'));
        $data['empty_message'] = 'No data found';
        return view($this->activeTemplate . '.user.transactions', $data);
    }
    public function transferlog()
    {
        $data['page_title'] = "Transfer details";
        $data['transactions'] = Transaction::where('user_id', auth()->id())->where('remark', 'balance_transfer')->orderBy('id', 'DESC')->paginate(config('constants.table.default'));
        $data['empty_message'] = 'No data found';
        return view($this->activeTemplate . '.user.transactions', $data);
    }

    public function investLog(Request $request)
    {

        $search = $request->search;
        if ($search) {
            $data['page_title'] = "Invest search : " . $search;
            $data['transactions'] = auth()->user()->transactions()->where('remark', 'purchased_plan')->where('trx', 'like', "%$search%")->latest()->paginate(getPaginate());
        } else {
            $data['page_title'] = 'Invest Log';
            $data['transactions'] = auth()->user()->transactions()->where('remark', 'purchased_plan')->latest()->paginate(getPaginate());
        }
        $data['search'] = $search;

        $data['empty_message'] = 'No data found.';
        return view($this->activeTemplate . 'user.transactions', $data);

    }

    public function binaryCom(Request $request)
    {

        $search = $request->search;
        if ($search) {
            $data['page_title'] = "Tree Commissions search : " . $search;
            $data['transactions'] = auth()->user()->transactions()->where('remark', 'binary_commission')->where('trx', 'like', "%$search%")->latest()->paginate(getPaginate());
        } else {
            $data['page_title'] = 'Tree Commissions';
            $data['transactions'] = auth()->user()->transactions()->where('remark', 'binary_commission')->latest()->paginate(getPaginate());
        }
        $data['search'] = $search;

        $data['empty_message'] = 'No data found.';
        return view($this->activeTemplate . 'user.transactions', $data);

    }
    public function transactions(Request $request)
    {

        $search = $request->search;
        if ($search) {
            $data['page_title'] = "Transaction search : " . $search;
            $data['transactions'] = auth()->user()->transactions()->where('trx', 'like', "%$search%")->latest()->paginate(getPaginate());
        } else {
            $data['page_title'] = 'Transaction Log';
            $data['transactions'] = auth()->user()->transactions()->latest()->paginate(getPaginate());
        }
        $data['search'] = $search;
        $data['empty_message'] = 'No transactions.';
        return view($this->activeTemplate . 'user.transactions', $data);

    }

    public function depositHistory(Request $request)
    {

        $search = $request->search;

        if ($search) {
            $data['page_title'] = "Deposit search : " . $search;
            $data['logs'] = auth()->user()->deposits()->where('trx', 'like', "%$search%")->with(['gateway'])->latest()->paginate(getPaginate());
        } else {
            $data['page_title'] = 'Deposit Log';
            $data['logs'] = auth()->user()->deposits()->with(['gateway'])->latest()->paginate(getPaginate());
        }
        $data['search'] = $search;
        $data['empty_message'] = 'No history found.';


        return view($this->activeTemplate . 'user.deposit_history', $data);
    }


    public function withdrawLog(Request $request)
    {
        $search = $request->search;

        if ($search) {
            $data['page_title'] = "Withdraw search : " . $search;
            $data['withdraws'] = auth()->user()->withdrawals()->where('trx', 'like', "%$search%")->with('method')->latest()->paginate(getPaginate());
        } else {
            $data['page_title'] = "Withdraw Log";
            $data['withdraws'] = auth()->user()->withdrawals()->with('method')->latest()->paginate(getPaginate());
        }
        $data['search'] = $search;
        $data['empty_message'] = "No Data Found!";
        return view($this->activeTemplate . 'user.withdraw.log', $data);
    }
    public function binarySummery(Request $request)
    {
        if ($request->userID)
        {
           $data['page_title'] = "Tree Summery";
           $users = User::where('level1_parent', $request->userID)->orWhere('level2_parent', $request->userID)->orWhere('level3_parent', $request->userID)->orWhere('level4_parent', $request->userID)->orWhere('level5_parent', $request->userID)->orWhere('level6_parent', $request->userID)->orWhere('level7_parent', $request->userID)->get();
            $data['users'] = $users->paginate(getPaginate());
            return view($this->activeTemplate . '.user.binarySummery', $data);
        }
    }
}
