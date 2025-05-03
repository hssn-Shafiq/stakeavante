<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Transaction;
use App\Models\UserLogin;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function bvLog(Request $request)
    {
        $page_title = 'Reward Logs';
        $transactions = Transaction::where('remark', 'bonus_commission')->with('user')->latest()->paginate(getPaginate());
        $empty_message = 'No transactions.';
        return view('admin.reports.transactions', compact('page_title', 'transactions', 'empty_message'));
    }
    public function binary(Request $request)
    {
        if ($request->userID)
        {
            $user = User::findOrFail($request->userID);
            $page_title = $user->username . ' - Tree Commission Logs';
            $transactions = Transaction::where('user_id', $user->id)->where('remark', 'binary_commission')->with('user')->latest()->paginate(getPaginate());
        }else {
            $page_title = 'Tree Commission Logs';
            $transactions = Transaction::where('remark', 'binary_commission')->with('user')->latest()->paginate(getPaginate());
        }

        $empty_message = 'No transactions.';
        return view('admin.reports.transactions', compact('page_title', 'transactions', 'empty_message'));
    }
    public function binarySummery(Request $request)
    {
        if ($request->userID)
        {
           $data['page_title'] = "Tree Summery";
           $users = User::where('level1_parent', $request->userID)->orWhere('level2_parent', $request->userID)->orWhere('level3_parent', $request->userID)->orWhere('level4_parent', $request->userID)->orWhere('level5_parent', $request->userID)->orWhere('level6_parent', $request->userID)->orWhere('level7_parent', $request->userID)->get();
            $data['users'] = $users->paginate(getPaginate());
            return view('admin.reports.binarySummery', $data);
        }
    }
    public function invest(Request $request)
    {
        if ($request->userID)
        {
            $user = User::findOrFail($request->userID);
            $page_title = $user->username . ' - Invest Logs';
            $transactions = Transaction::where('user_id', $user->id)->where('remark', 'purchased_plan')->with('user')->latest()->paginate(getPaginate());
        }else {
            $page_title = 'Invest Logs';
            $transactions = Transaction::where('remark', 'purchased_plan')->with('user')->latest()->paginate(getPaginate());
        }

        $empty_message = 'No transactions.';
        return view('admin.reports.transactions', compact('page_title', 'transactions', 'empty_message'));
    }
    public function transaction()
    {
        $page_title = 'Transaction Logs';
        $transactions = Transaction::with('user')->orderBy('id','desc')->paginate(getPaginate());
        $empty_message = 'No transactions.';
        return view('admin.reports.transactions', compact('page_title', 'transactions', 'empty_message'));
    }

    public function transactionSearch(Request $request)
    {
        $request->validate(['search' => 'required']);
        $search = $request->search;
        $page_title = 'Transactions Search - ' . $search;
        $empty_message = 'No transactions.';

        $transactions = Transaction::with('user')->whereHas('user', function ($user) use ($search) {
            $user->where('username', 'like',"%$search%");
        })->orWhere('trx', $search)->orderBy('id','desc')->paginate(getPaginate());

        return view('admin.reports.transactions', compact('page_title', 'transactions', 'empty_message'));
    }

    public function loginHistory(Request $request)
    {
        if ($request->search) {
            $search = $request->search;
            $page_title = 'User Login History Search - ' . $search;
            $empty_message = 'No search result found.';
            $login_logs = UserLogin::whereHas('user', function ($query) use ($search) {
                $query->where('username', $search);
            })->orderBy('id','desc')->paginate(getPaginate());
            return view('admin.reports.logins', compact('page_title', 'empty_message', 'search', 'login_logs'));
        }
        $page_title = 'User Login History';
        $empty_message = 'No users login found.';
        $login_logs = UserLogin::orderBy('id','desc')->paginate(getPaginate());
        return view('admin.reports.logins', compact('page_title', 'empty_message', 'login_logs'));
    }

    public function loginIpHistory($ip)
    {
        $page_title = 'Login By - ' . $ip;
        $login_logs = UserLogin::where('user_ip',$ip)->orderBy('id','desc')->paginate(getPaginate());
        $empty_message = 'No users login found.';
        return view('admin.reports.logins', compact('page_title', 'empty_message', 'login_logs'));

    }
}
