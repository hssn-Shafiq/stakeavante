<?php

namespace App\Http\Controllers;

use App\Lib\GoogleAuthenticator;
use App\Models\AdminNotification;
use App\Models\Deposit;
use App\Models\GeneralSetting;
use App\Models\Transaction;
use App\Models\User;
use App\Models\WithdrawMethod;
use App\Models\Withdrawal;
use App\Models\Membership;
use App\Models\Plan;
use App\Models\UserProfit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Image;
use Validator;
use Carbon\Carbon;

class UserController extends Controller
{
    public function __construct()
    {
        $this->activeTemplate = activeTemplate();
    }  public function home()
{
    $general = GeneralSetting::first();
    $data = [];
    
    if (auth()->user()) {
        // For free coins
        $user = auth()->user();
        $today = Carbon::now()->toDateString();
        $todayDate = Carbon::parse($today);
        $previous = Carbon::parse($user->free_coin_date)->toDateString();
        $previousDate = Carbon::parse($previous);
        $difference = $previousDate->diffInDays($todayDate);
        
        // Calculate daily profit
        $plan = Plan::where('id', auth()->user()->plan_id)->first();
        $total_invest = auth()->user()->total_invest;
        $todayDateFormatted = Carbon::now()->format('Y-m-d');

        // Check if profit was credited today
        $profit = UserProfit::getUserProfitForDate(auth()->id(), $todayDateFormatted);
        
        if ($profit) {
            // Profit already credited today, display the credited amount
            $data['daily_profit'] = round($profit->amount ?? $profit->profit, 2);
            $data['profit_status'] = 'credited';
            
            // Calculate time until next profit (24 hours from last profit)
            $lastProfitTime = Carbon::parse($profit->created_at);
            $nextProfitTime = $lastProfitTime->copy()->addDay();
            $hoursRemaining = Carbon::now()->diffInHours($nextProfitTime, false);
            $minutesRemaining = Carbon::now()->diffInMinutes($nextProfitTime, false) % 60;
            
            $data['next_profit_hours'] = $hoursRemaining;
            $data['next_profit_minutes'] = $minutesRemaining;
            $data['next_profit_time'] = $nextProfitTime->format('Y-m-d H:i:s');
        } else {
            // No profit credited yet, calculate expected daily profit
            if ($plan && $total_invest > 0 && auth()->user()->plan_expiry > Carbon::now()) {
                // Calculate daily profit based on plan's profit percentage
                $monthly_profit = ceil($total_invest * $plan->profit / 100);
                $totalDays = Carbon::now()->daysInMonth; // Still using monthly division for consistency
                $daily_profit = round($monthly_profit / $totalDays, 2);
                $data['daily_profit'] = $daily_profit;
                $data['profit_status'] = 'pending'; // Indicates profit not yet credited
                
                // For pending profits, show time until midnight when cron will run
                $tomorrow = Carbon::tomorrow()->startOfDay();
                $hoursRemaining = Carbon::now()->diffInHours($tomorrow, false);
                $minutesRemaining = Carbon::now()->diffInMinutes($tomorrow, false) % 60;
                
                $data['next_profit_hours'] = $hoursRemaining;
                $data['next_profit_minutes'] = $minutesRemaining;
                $data['next_profit_time'] = $tomorrow->format('Y-m-d H:i:s');
            } else {
                $data['daily_profit'] = 'NA';
                $data['profit_status'] = 'inactive'; // No valid plan or investment
                $data['next_profit_hours'] = null;
                $data['next_profit_minutes'] = null;
                $data['next_profit_time'] = null;
            }
        }
        
        // Store coin-related data
        $data['coins_date_diff'] = $difference;
        $data['coins_availed'] = $user->last_free_coins;
    } else {
        $data['daily_profit'] = 'NA';
        $data['profit_status'] = 'inactive';
        $data['coins_date_diff'] = 0;
        $data['coins_availed'] = 0;
    }

    // Dashboard statistics
    $data['page_title'] = "Dashboard";
    $data['totalDeposit'] = Deposit::where('user_id', auth()->id())->where('status', 1)->sum('amount');
    $data['totalWithdraw'] = Withdrawal::where('user_id', auth()->id())->where('status', 1)->sum('amount');
    $data['total_ref'] = User::where('ref_id', auth()->id())->count();
    $data['totalTreeUsers'] = User::where('level1_parent', auth()->id())
        ->orWhere('level2_parent', auth()->id())
        ->orWhere('level3_parent', auth()->id())
        ->orWhere('level4_parent', auth()->id())
        ->orWhere('level5_parent', auth()->id())
        ->orWhere('level6_parent', auth()->id())
        ->orWhere('level7_parent', auth()->id())
        ->count();

    return view($this->activeTemplate . 'user.dashboard', $data);
}
    public function profile()
    {
        $data['page_title'] = "Profile Setting";
        $data['user'] = Auth::user();
        return view($this->activeTemplate. 'user.profile-setting', $data);
    }

    public function submitProfile(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'firstname' => 'required|string|max:50',
            'lastname' => 'required|string|max:50',
            //'email' => 'required|email|max:160|unique:users,email,' . $user->id,
            'address' => "nullable|max:80",
            'state' => 'nullable|max:80',
            'zip' => 'nullable|max:40',
            'city' => 'nullable|max:50',
            'image' => 'mimes:png,jpg,jpeg'
        ]);
        /*if ($request->email != $user->email && User::whereEmail($request->email)->where('id','!=', $user->id)->count() > 0) {
            $notify[] = ['error', 'Email already exists.'];
            return back()->withNotify($notify);
        }*/
        if ($request->mobile != $user->mobile && User::where('mobile', $request->mobile)->where('id','!=', $user->id)->count() > 0) {
            $notify[] = ['error', 'Phone number already exists.'];
            return back()->withNotify($notify);
        }


        $in['firstname'] = $request->firstname;
        $in['lastname'] = $request->lastname;
        $in['mobile'] = $request->mobile;
        //$in['email'] = $request->email;

        $in['address'] = [
            'address' => $request->address,
            'state' => $request->state,
            'zip' => $request->zip,
            'country' => $request->country,
            'city' => $request->city,
        ];

        $user = Auth::user();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $user->username . '.jpg';
            $location = 'assets/images/user/profile/' . $filename;
            $in['image'] = $filename;

            $path = './assets/images/user/profile/';
            $link = $path . $user->image;
            if (file_exists($link)) {
                @unlink($link);
            }
            $size = imagePath()['profile']['user']['size'];
            $image = Image::make($image);
            $size = explode('x', strtolower($size));
            $image->resize($size[0], $size[1]);
            $image->save($location);
        }
        $user->fill($in)->save();
        $notify[] = ['success', 'Profile Updated successfully.'];
        return back()->withNotify($notify);
    }

    public function changePassword()
    {
        $data['page_title'] = "CHANGE PASSWORD";
        return view($this->activeTemplate . 'user.password', $data);
    }

    public function submitPassword(Request $request)
    {

        $this->validate($request, [
            'current_password' => 'required',
            'password' => 'required|min:5|confirmed'
        ]);
        try {
            $user = auth()->user();
            if (Hash::check($request->current_password, $user->password)) {
                $password = Hash::make($request->password);
                $user->password = $password;
                $user->save();
                $notify[] = ['success', 'Password Changes successfully.'];
                return back()->withNotify($notify);
            } else {
                $notify[] = ['error', 'Current password not match.'];
                return back()->withNotify($notify);
            }
        } catch (\PDOException $e) {
            $notify[] = ['error', $e->getMessage()];
            return back()->withNotify($notify);
        }
    }
    function socialCount(Request $request){
        if($request->id){
            $id = $request->id;
            $user = auth()->user();
            $user->social_count+=1;
            $user->save();
            return response()->json(['success' => true]);
        }else{
            return response()->json(['success' => false]);
        }
    }
    function freeCoins(){
        //dd('Saeed');
        $general = GeneralSetting::first();
        if(auth()->user()){
            $user = auth()->user();
            $today=Carbon::now()->toDateString();
            $todayDate=Carbon::parse($today);
            $previous=Carbon::parse($user->free_coin_date)->toDateString();
            $previousDate=Carbon::parse($previous);
            $difference=$previousDate->diffInDays($todayDate);
            if($difference > 0){
                if($difference==1){
                    $last_free_coins1=($general->coin_daily+(0*$general->coin_multiple));
                    $last_free_coins2=($general->coin_daily+(1*$general->coin_multiple));
                    $last_free_coins3=($general->coin_daily+(2*$general->coin_multiple));
                    $last_free_coins4=($general->coin_daily+(3*$general->coin_multiple));
                    $last_free_coins5=($general->coin_daily+(4*$general->coin_multiple));
                    $last_free_coins6=($general->coin_daily+(5*$general->coin_multiple));
                    if($user->last_free_coins==$last_free_coins1){
                        $newCoins=($general->coin_daily+(1*$general->coin_multiple));
                    }elseif ($user->last_free_coins==$last_free_coins2) {
                        $newCoins=($general->coin_daily+(2*$general->coin_multiple));
                    }elseif ($user->last_free_coins==$last_free_coins3) {
                        $newCoins=($general->coin_daily+(3*$general->coin_multiple));
                    }elseif ($user->last_free_coins==$last_free_coins4) {
                        $newCoins=($general->coin_daily+(4*$general->coin_multiple));
                    }elseif ($user->last_free_coins==$last_free_coins5) {
                        $newCoins=($general->coin_daily+(5*$general->coin_multiple));
                    }elseif ($user->last_free_coins==$last_free_coins6) {
                        $newCoins=($general->coin_daily+(6*$general->coin_multiple));
                    }else{
                        $newCoins=$general->coin_daily;
                    }
                }else{
                        $newCoins=$general->coin_daily;
                    }
                $mytime = Carbon::now();
                $mytime->toDateTimeString();
                $user->free_coins+=$newCoins;
                $user->last_free_coins=$newCoins;
                $user->free_coin_date=$mytime;
                $user->save();
                $notify[] = ['success', 'Free coins added successfully.'];
            return back()->withNotify($notify);
            }else{
                $notify[] = ['error', 'Please avail next day.'];
            return back()->withNotify($notify);
            }
        }
    }    public function profitHistory()
    {
        $page_title = 'Daily Profit History';
        $empty_message = 'No profit records found.';
        $profits = UserProfit::where('user_id', auth()->id())
            ->with('user')
            ->latest()
            ->paginate(getPaginate());
        $general = GeneralSetting::first();
        
        return view($this->activeTemplate . 'user.profit_history', compact('page_title', 'empty_message', 'profits', 'general'));
    }

    public function depositHistory()
    {
        $page_title = 'Deposit History';
        $empty_message = 'No history found.';
        $logs = auth()->user()->deposits()->with(['gateway'])->latest()->paginate(getPaginate());
        return view($this->activeTemplate . 'user.deposit_history', compact('page_title', 'empty_message', 'logs'));
    }

    /*
     * Withdraw Operation
     */

    public function withdrawMoney()
    {
        $data['withdrawMethod'] = WithdrawMethod::whereStatus(1)->get();
        $data['page_title'] = "Withdraw Money";
        return view(activeTemplate() . 'user.withdraw.methods', $data);
    }

    public function withdrawStore(Request $request)
    {
        $this->validate($request, [
            'method_code' => 'required',
            'amount' => 'required|numeric'
        ]);
        $method = WithdrawMethod::where('id', $request->method_code)->where('status', 1)->firstOrFail();
        $user = auth()->user();
        if ($request->amount < $method->min_limit) {
            $notify[] = ['error', 'Your Requested Amount is Smaller Than Minimum Amount.'];
            return back()->withNotify($notify);
        }
        if ($request->amount > $method->max_limit) {
            $notify[] = ['error', 'Your Requested Amount is Larger Than Maximum Amount.'];
            return back()->withNotify($notify);
        }

        if ($request->amount > $user->balance) {
            $notify[] = ['error', 'Your do not have Sufficient Balance For Withdraw.'];
            return back()->withNotify($notify);
        }


        $charge = $method->fixed_charge + ($request->amount * $method->percent_charge / 100);
        $afterCharge = $request->amount - $charge;
        $finalAmount = getAmount($afterCharge * $method->rate);

        $withdraw = new Withdrawal();
        $withdraw->method_id = $method->id; // wallet method ID
        $withdraw->user_id = $user->id;
        $withdraw->amount = getAmount($request->amount);
        $withdraw->currency = $method->currency;
        $withdraw->rate = $method->rate;
        $withdraw->charge = $charge;
        $withdraw->final_amount = $finalAmount;
        $withdraw->after_charge = $afterCharge;
        $withdraw->trx = getTrx();
        $withdraw->save();
        session()->put('wtrx', $withdraw->trx);
        return redirect()->route('user.withdraw.preview');
    }

    public function withdrawPreview()
    {
        $data['withdraw'] = Withdrawal::with('method','user')->where('trx', session()->get('wtrx'))->where('status', 0)->latest()->firstOrFail();
        $data['page_title'] = "Withdraw Preview";
        return view($this->activeTemplate . 'user.withdraw.preview', $data);
    }


    public function withdrawSubmit(Request $request)
    {
        $general = GeneralSetting::first();
        $withdraw = Withdrawal::with('method','user')->where('trx', session()->get('wtrx'))->where('status', 0)->latest()->firstOrFail();

        $rules = [];
        $inputField = [];
        if ($withdraw->method->user_data != null) {
            foreach ($withdraw->method->user_data as $key => $cus) {
                $rules[$key] = [$cus->validation];
                if ($cus->type == 'file') {
                    array_push($rules[$key], 'image');
                    array_push($rules[$key], 'mimes:jpeg,jpg,png');
                    array_push($rules[$key], 'max:2048');
                }
                if ($cus->type == 'text') {
                    array_push($rules[$key], 'max:191');
                }
                if ($cus->type == 'textarea') {
                    array_push($rules[$key], 'max:300');
                }
                $inputField[] = $key;
            }
        }
        $this->validate($request, $rules);
        $user = auth()->user();

        if (getAmount($withdraw->amount) > $user->balance) {
            $notify[] = ['error', 'Your Request Amount is Larger Then Your Current Balance.'];
            return back()->withNotify($notify);
        }

        $directory = date("Y")."/".date("m")."/".date("d");
        $path = imagePath()['verify']['withdraw']['path'].'/'.$directory;
        $collection = collect($request);
        $reqField = [];
        if ($withdraw->method->user_data != null) {
            foreach ($collection as $k => $v) {
                foreach ($withdraw->method->user_data as $inKey => $inVal) {
                    if ($k != $inKey) {
                        continue;
                    } else {
                        if ($inVal->type == 'file') {
                            if ($request->hasFile($inKey)) {
                                try {
                                    $reqField[$inKey] = [
                                        'field_name' => $directory.'/'.uploadImage($request[$inKey], $path),
                                        'type' => $inVal->type,
                                    ];
                                } catch (\Exception $exp) {
                                    $notify[] = ['error', 'Could not upload your ' . $request[$inKey]];
                                    return back()->withNotify($notify)->withInput();
                                }
                            }
                        } else {
                            $reqField[$inKey] = $v;
                            $reqField[$inKey] = [
                                'field_name' => $v,
                                'type' => $inVal->type,
                            ];
                        }
                    }
                }
            }
            $withdraw['withdraw_information'] = $reqField;
        } else {
            $withdraw['withdraw_information'] = null;
        }


        $withdraw->status = 2;
        $withdraw->save();
        $user->balance  -=  $withdraw->amount;
        $user->save();



        $transaction = new Transaction();
        $transaction->user_id = $withdraw->user_id;
        $transaction->amount = getAmount($withdraw->amount);
        $transaction->post_balance = getAmount($user->balance);
        $transaction->charge = getAmount($withdraw->charge);
        $transaction->trx_type = '-';
        $transaction->details = getAmount($withdraw->final_amount) . ' ' . $withdraw->currency . ' Withdraw Via ' . $withdraw->method->name;
        $transaction->trx =  $withdraw->trx;
        $transaction->save();

        $adminNotification = new AdminNotification();
        $adminNotification->user_id = $user->id;
        $adminNotification->title = 'New withdraw request from '.$user->username;
        $adminNotification->click_url = route('admin.withdraw.details',$withdraw->id);
        $adminNotification->save();

       /* notify($user, 'WITHDRAW_REQUEST', [
            'method_name' => $withdraw->method->name,
            'method_currency' => $withdraw->currency,
            'method_amount' => getAmount($withdraw->final_amount),
            'amount' => getAmount($withdraw->amount),
            'charge' => getAmount($withdraw->charge),
            'currency' => $general->cur_text,
            'rate' => getAmount($withdraw->rate),
            'trx' => $withdraw->trx,
            'post_balance' => getAmount($user->balance),
            'delay' => $withdraw->method->delay
        ]);*/

        $notify[] = ['success', 'Withdraw Request Successfully Send'];
        return redirect()->route('user.withdraw.history')->withNotify($notify);
    }

    public function withdrawLog()
    {
        $data['page_title'] = "Withdraw Log";
        $data['withdraws'] = Withdrawal::where('user_id', Auth::id())->where('status', '!=', 0)->with('method')->latest()->paginate(getPaginate());
        $data['empty_message'] = "No Data Found!";
        return view($this->activeTemplate.'user.withdraw.log', $data);
    }



    public function show2faForm()
    {
        $gnl = GeneralSetting::first();
        $ga = new GoogleAuthenticator();
        $user = auth()->user();
        $secret = $ga->createSecret();
        $qrCodeUrl = $ga->getQRCodeGoogleUrl($user->username . '@' . $gnl->sitename, $secret);
        $prevcode = $user->tsc;
        $prevqr = $ga->getQRCodeGoogleUrl($user->username . '@' . $gnl->sitename, $prevcode);
        $page_title = 'Two Factor';
        return view($this->activeTemplate.'user.twofactor', compact('page_title', 'secret', 'qrCodeUrl', 'prevcode', 'prevqr'));
    }

    public function create2fa(Request $request)
    {
        $user = auth()->user();
        $this->validate($request, [
            'key' => 'required',
            'code' => 'required',
        ]);

        $ga = new GoogleAuthenticator();
        $secret = $request->key;
        $oneCode = $ga->getCode($secret);

        if ($oneCode === $request->code) {
            $user->tsc = $request->key;
            $user->ts = 1;
            $user->tv = 1;
            $user->save();


            $userAgent = getIpInfo();
            $osBrowser = osBrowser();
            /*notify($user, '2FA_ENABLE', [
                'operating_system' => @$osBrowser['os_platform'],
                'browser' => @$osBrowser['browser'],
                'ip' => @$userAgent['ip'],
                'time' => @$userAgent['time']
            ]);*/


            $notify[] = ['success', 'Google Authenticator Enabled Successfully'];
            return back()->withNotify($notify);
        } else {
            $notify[] = ['error', 'Wrong Verification Code'];
            return back()->withNotify($notify);
        }
    }


    public function disable2fa(Request $request)
    {
        $this->validate($request, [
            'code' => 'required',
        ]);

        $user = auth()->user();
        $ga = new GoogleAuthenticator();

        $secret = $user->tsc;
        $oneCode = $ga->getCode($secret);
        $userCode = $request->code;

        if ($oneCode == $userCode) {

            $user->tsc = null;
            $user->ts = 0;
            $user->tv = 1;
            $user->save();


            $userAgent = getIpInfo();
            $osBrowser = osBrowser();
            /*notify($user, '2FA_DISABLE', [
                'operating_system' => @$osBrowser['os_platform'],
                'browser' => @$osBrowser['browser'],
                'ip' => @$userAgent['ip'],
                'time' => @$userAgent['time']
            ]);*/


            $notify[] = ['success', 'Two Factor Authenticator Disable Successfully'];
            return back()->withNotify($notify);
        } else {
            $notify[] = ['error', 'Wrong Verification Code'];
            return back()->with($notify);
        }
    }
    function indexTransfer()
    {
        $page_title = 'Balance Transfer';
        return view($this->activeTemplate . '.user.balanceTransfer', compact('page_title'));
    }

    function balanceTransfer(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'amount' => 'required|numeric|min:0',
        ]);
        $gnl = GeneralSetting::first();
        $user = User::find(Auth::id());
        $trans_user = User::where('username', $request->username)->orWhere('email', $request->username)->first();
        if ($trans_user == '') {
            $notify[] = ['error', 'Username Not Found'];
            return back()->withNotify($notify);
        }
        if ($trans_user->username == $user->username) {
            $notify[] = ['error', 'Balance Transfer Not Possible In Your Own Account'];
            return back()->withNotify($notify);
        }
        if ($trans_user->email == $user->email) {
            $notify[] = ['error', 'Balance Transfer Not Possible In Your Own Account'];
            return back()->withNotify($notify);
        }
        /*if ($request->otp != $user->transfer_code) {
            $notify[] = ['error', 'Invalid OTP'];
            return back()->withNotify($notify);
        }*/
        $charge = $gnl->bal_trans_fixed_charge + (($request->amount * $gnl->bal_trans_per_charge) / 100);
        $amount = $request->amount + $charge;
        if ($user->balance >= $amount) {
            $user->balance -= $amount;
            $user->save();

            $trx = getTrx();

            Transaction::create([
                'trx' => $trx,
                'user_id' => $user->id,
                'trx_type' => '-',
                'remark' => 'balance_transfer',
                'details' => 'Balance Transferred To ' . $trans_user->username,
                'amount' => getAmount($request->amount),
                'post_balance' => getAmount($user->balance),
                'charge' => $charge
            ]);

            notify($user, 'BAL_SEND', [
                'amount' => getAmount($request->amount),
                'username' => $trans_user->username,
                'trx' => $trx,
                'currency' => $gnl->cur_text,
                'charge' => getAmount($charge),
                'balance_now' => getAmount($user->balance),
            ]);

            $trans_user->balance += $request->amount;
            $trans_user->save();

            Transaction::create([
                'trx' => $trx,
                'user_id' => $trans_user->id,
                'remark' => 'balance_receive',
                'details' => 'Balance receive From ' . $user->username,
                'amount' => getAmount($request->amount),
                'post_balance' => getAmount($trans_user->balance),
                'charge' => 0,
                'trx_type' => '+'
            ]);

            notify($trans_user, 'BAL_RECEIVE', [
                'amount' => getAmount($request->amount),
                'currency' => $gnl->cur_text,
                'trx' => $trx,
                'username' => $user->username,
                'charge' => 0,
                'balance_now' => getAmount($trans_user->balance),
            ]);

            $notify[] = ['success', 'Balance Transferred Successfully.'];
            return back()->withNotify($notify);
        } else {
            $notify[] = ['error', 'Insufficient Balance.'];
            return back()->withNotify($notify);

        }
    }


    function searchUser(Request $request)
    {
        $trans_user = User::where('username', $request->username)->orWhere('email', $request->username)->first();
        if ($trans_user) {
            return response()->json(['success' => true,'username'=>$trans_user->firstname.' '.$trans_user->lastname]);
        } else {
            return response()->json(['success' => false]);
        }

    }
    function otpSend(Request $request)
    {
        if($request->id){
        $user = auth()->user();
        $code = verificationCode(6);
        $userIpInfo = getIpInfo();
        $userBrowser = osBrowser();
        sendEmail($user, 'TRANSFER_CODE', [
            'code' => $code,
            'operating_system' => $userBrowser['os_platform'],
            'browser' => $userBrowser['browser'],
            'ip' => $userIpInfo['ip'],
            'time' => $userIpInfo['time']
        ]);
        $user->transfer_code=$code;
        $user->save();
        return response()->json(['success' => true]);
        }else{
        return response()->json(['success' => false]); 
        }
    }
    function otpVerify(Request $request)
    {
        $user = auth()->user();
        if($request->otp==$user->transfer_code){
            return response()->json(['success' => true]);
        }else{
            return response()->json(['success' => false]);
        }
    }
    public function userLoginHistory()
    {
        $page_title = 'User Login History';
        $empty_message = 'No users login found.';
        $login_logs = auth()->user()->login_logs()->latest()->paginate(getPaginate());
        return view($this->activeTemplate.'user.logins', compact('page_title', 'empty_message', 'login_logs'));
    }
}
