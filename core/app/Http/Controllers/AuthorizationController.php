<?php
namespace App\Http\Controllers;
use App\Lib\GoogleAuthenticator;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\Frontend;
class AuthorizationController extends Controller
{

    public function __construct()

    {

        return $this->activeTemplate = activeTemplate();

    }

    public function checkValidCode($user, $code, $add_min = 10000)

    {

        if (!$code) return false;

        if (!$user->ver_code_send_at) return false;

        if ($user->ver_code_send_at->addMinutes($add_min) < Carbon::now()) return false;

        if ($user->ver_code !== $code) return false;

        return true;

    }





    public function authorizeForm()

    {



        if (auth()->check()) {



            $user = auth()->user();

            if (!$user->status) {

                Auth::logout();

            }elseif (!$user->ev) {

                if (!$this->checkValidCode($user, $user->ver_code)) {

                    $user->ver_code = verificationCode(6);

                    $user->ver_code_send_at = Carbon::now();

                    $user->save();

                    sendEmail($user, 'EVER_CODE', [

                        'code' => $user->ver_code

                    ]);

                }

                $page_title = 'Email verification form';



                $content = Frontend::where('data_keys', 'email_verify_page.content')->first();

                return view($this->activeTemplate.'user.auth.authorization.email', compact('user', 'page_title', 'content'));

            }elseif (!$user->sv) {

                if (!$this->checkValidCode($user, $user->ver_code)) {

                    $user->ver_code = verificationCode(6);

                    $user->ver_code_send_at = Carbon::now();

                    $user->save();

                    sendSms($user, 'SVER_CODE', [

                        'code' => $user->ver_code

                    ]);

                }

                $page_title = 'SMS verification form';



                $content = Frontend::where('data_keys', 'sms_verify_page.content')->first();

                return view($this->activeTemplate.'user.auth.authorization.sms', compact('user', 'page_title', 'content'));

            }elseif (!$user->tv) {

                $page_title = 'Google Authenticator';



                $content = Frontend::where('data_keys', '2fa_verify_page.content')->first();

                return view($this->activeTemplate.'user.auth.authorization.2fa', compact('user', 'page_title', 'content'));

            }else{

                return redirect()->route('user.home');

            }



        }



        return redirect()->route('user.login');

    }



    public function sendVerifyCode(Request $request)

    {

        $user = Auth::user();





        if ($this->checkValidCode($user, $user->ver_code, 2)) {

            $target_time = $user->ver_code_send_at->addMinutes(2)->timestamp;

            $delay = $target_time - time();

            throw ValidationException::withMessages(['resend' => 'Please Try after ' . $delay . ' Seconds']);

        }

        if (!$this->checkValidCode($user, $user->ver_code)) {

            $user->ver_code = verificationCode(6);

            $user->ver_code_send_at = Carbon::now();

            $user->save();

        } else {

            $user->ver_code = $user->ver_code;

            $user->ver_code_send_at = Carbon::now();

            $user->save();

        }







        if ($request->type === 'email') {

            sendEmail($user, 'EVER_CODE',[

                'code' => $user->ver_code

            ]);



            $notify[] = ['success', 'Email verification code sent successfully'];

            return back()->withNotify($notify);

        } elseif ($request->type === 'phone') {

            sendSms($user, 'SVER_CODE', [

                'code' => $user->ver_code

            ]);

            $notify[] = ['success', 'SMS verification code sent successfully'];

            return back()->withNotify($notify);

        } else {

            throw ValidationException::withMessages(['resend' => 'Sending Failed']);

        }

    }



    public function emailVerification(Request $request)

    {

        $request->validate([

            'code' => 'required',

        ]);



        $email_verified_code =  $request->code;



        $user = Auth::user();



        if ($this->checkValidCode($user, $email_verified_code)) {

            $user->ev = 1;

            $user->ver_code = null;

            $user->ver_code_send_at = null;

            $user->save();

            return redirect()->intended(route('user.home'));

        }

        throw ValidationException::withMessages(['email_verified_code' => 'Verification code didn\'t match!']);

    }



    public function smsVerification(Request $request)

    {

        $request->validate([

            'code' => 'required',

        ]);



        $sms_verified_code =  $request->code;



        $user = Auth::user();

        if ($this->checkValidCode($user, $sms_verified_code)) {

            $user->sv = 1;

            $user->ver_code = null;

            $user->ver_code_send_at = null;

            $user->save();

            return redirect()->intended(route('user.home'));

        }

        throw ValidationException::withMessages(['sms_verified_code' => 'Verification code didn\'t match!']);

    }



    public function g2faVerification(Request $request)

    {

        $user = auth()->user();



        $request->validate([

            'code' => 'required',

        ]);



        $ga     = new GoogleAuthenticator();

        $code   = $request->code;

        $secret = $user->tsc;

        $oneCode = $ga->getCode($secret);

        $userCode = $code;

        if ($oneCode == $userCode) {

            $user->tv = 1;

            $user->save();

            return redirect()->route('user.home');

        } else {

            $notify[] = ['error', 'Wrong Verification Code'];

            return back()->withNotify($notify);

        }
    }
}
