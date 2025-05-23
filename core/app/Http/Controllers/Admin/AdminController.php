<?php
namespace App\Http\Controllers\Admin;
use App\Models\Deposit;

use App\Models\Gateway;

use App\Models\Transaction;

use App\Models\User;

use App\Models\UserLogin;

use App\Models\Withdrawal;

use App\Models\WithdrawMethod;

use Carbon\Carbon;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;

use App\Models\AdminNotification;



class AdminController extends Controller

{



    public function dashboard()

    {

        $page_title = 'Dashboard';



        // User Info

        $widget['total_users'] = User::count();

        $widget['unpaid_users'] = User::where('status', 1)->where('plan_id',0)->count();

        $widget['banned_users'] = User::where('status', 0)->count();

        $widget['users_balance'] = User::sum('balance');

        $widget['users_invest'] = User::sum('total_invest');
        $widget['free_coins'] = User::sum('free_coins');

        $widget['last7days_invest'] = Transaction::whereDate('created_at', '>=', Carbon::now()->subDays(6))->where('remark', 'purchased_plan')->sum('amount');

        $widget['total_binary_com'] = User::sum('total_binary_com');
        $widget['total_indir_com'] = User::sum('total_indir_com');





        // Monthly Deposit & Withdraw Report Graph

        $report['months'] = collect([]);

        $report['deposit_month_amount'] = collect([]);

        $report['withdraw_month_amount'] = collect([]);



        $depositsMonth = Deposit::whereYear('created_at', '>=', Carbon::now()->subYear())

            ->selectRaw("SUM( CASE WHEN status = 1 THEN amount END) as depositAmount")

            ->selectRaw("DATE_FORMAT(created_at,'%M') as months")

            ->orderBy('created_at')

            ->groupBy(DB::Raw("MONTH(created_at)"))->get();



        $depositsMonth->map(function ($aaa) use ($report) {

            $report['months']->push($aaa->months);

            $report['deposit_month_amount']->push(getAmount($aaa->depositAmount));

        });



        $withdrawalMonth = Withdrawal::whereYear('created_at', '>=', Carbon::now()->subYear())->where('status', 1)

            ->selectRaw("SUM( CASE WHEN status = 1 THEN amount END) as withdrawAmount")

            ->selectRaw("DATE_FORMAT(created_at,'%M') as months")

            ->orderBy('created_at')

            ->groupBy(DB::Raw("MONTH(created_at)"))->get();

        $withdrawalMonth->map(function ($bb) use ($report){

            $report['withdraw_month_amount']->push(getAmount($bb->withdrawAmount));

        });









        // Withdraw Graph

        $withdrawal = Withdrawal::where('created_at', '>=', \Carbon\Carbon::now()->subDays(30))->where('status', 1)

            ->select(array(DB::Raw('sum(amount)   as totalAmount'), DB::Raw('DATE(created_at) day')))

            ->groupBy('day')->get();

        $withdrawals['per_day'] = collect([]);

        $withdrawals['per_day_amount'] = collect([]);

        $withdrawal->map(function ($a) use ($withdrawals) {

            $withdrawals['per_day']->push(date('d M', strtotime($a->day)));

            $withdrawals['per_day_amount']->push($a->totalAmount + 0);

        });





        // user Browsing, Country, Operating Log

        $user_login_data = UserLogin::whereDate('created_at', '>=', \Carbon\Carbon::now()->subDay(30))->get(['browser', 'os', 'country']);



        $chart['user_browser_counter'] = $user_login_data->groupBy('browser')->map(function ($item, $key) {

            return collect($item)->count();

        });

        $chart['user_os_counter'] = $user_login_data->groupBy('os')->map(function ($item, $key) {

            return collect($item)->count();

        });

        $chart['user_country_counter'] = $user_login_data->groupBy('country')->map(function ($item, $key) {

            return collect($item)->count();

        })->sort()->reverse()->take(5);





        $payment['total_deposit_amount'] = Deposit::where('status',1)->sum('amount');

        $payment['total_deposit_charge'] = Deposit::where('status',1)->sum('charge');

        $payment['total_deposit_pending'] = Deposit::where('status',2)->count();

        $payment['total_deposit_reject'] = Deposit::where('status',3)->count();



        $paymentWithdraw['total_withdraw_amount'] = Withdrawal::where('status',1)->sum('amount');

        $paymentWithdraw['total_withdraw_charge'] = Withdrawal::where('status',1)->sum('charge');

        $paymentWithdraw['total_transfer_charge'] = Transaction::where('remark','balance_transfer')->sum('charge');

        $latestUser = User::latest()->limit(6)->get();



        return view('admin.dashboard', compact('page_title',

            'widget', 'report', 'withdrawals', 'chart','payment',

            'paymentWithdraw','latestUser', 'depositsMonth', 'withdrawalMonth'));

    }





    public function profile()

    {

        $page_title = 'Profile';

        $admin = Auth::guard('admin')->user();

        return view('admin.profile', compact('page_title', 'admin'));

    }



    public function profileUpdate(Request $request)

    {

        $this->validate($request, [

            'name' => 'required',

            'email' => 'required|email',

            'image' => 'nullable|image|mimes:jpg,jpeg,png'

        ]);



        $user = Auth::guard('admin')->user();



        if ($request->hasFile('image')) {

            try {

                $old = $user->image ?: null;

                $user->image = uploadImage($request->image, 'assets/admin/images/profile/', '400X400', $old);

            } catch (\Exception $exp) {

                $notify[] = ['error', 'Image could not be uploaded.'];

                return back()->withNotify($notify);

            }

        }



        $user->name = $request->name;

        $user->email = $request->email;

        $user->save();

        $notify[] = ['success', 'Your profile has been updated.'];

        return redirect()->route('admin.profile')->withNotify($notify);

    }





    public function password()

    {

        $page_title = 'Password Setting';

        $admin = Auth::guard('admin')->user();

        return view('admin.password', compact('page_title', 'admin'));

    }



    public function passwordUpdate(Request $request)

    {

        $this->validate($request, [

            'old_password' => 'required',

            'password' => 'required|min:5|confirmed',

        ]);



        $user = Auth::guard('admin')->user();

        if (!Hash::check($request->old_password, $user->password)) {

            $notify[] = ['error', 'Password Do not match !!'];

            return back()->withErrors(['Invalid old password.']);

        }

        $user->update([

            'password' => bcrypt($request->password)

        ]);

        $notify[] = ['success', 'Password Changed Successfully.'];

        return redirect()->route('admin.password')->withNotify($notify);

    }





    public function notifications(){

        $notifications = AdminNotification::orderBy('id','desc')->paginate(getPaginate());

        $page_title = 'Notifications';

        return view('admin.notifications',compact('page_title','notifications'));

    }





    public function notificationRead($id){

        $notification = AdminNotification::findOrFail($id);

        $notification->read_status = 1;

        $notification->save();

        return redirect($notification->click_url);

    }





}

