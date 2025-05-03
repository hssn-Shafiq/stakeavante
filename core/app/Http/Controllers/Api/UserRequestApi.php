<?php
namespace App\Http\Controllers\Api;
use App\Models\GeneralSetting;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserRequestApi extends Controller
{
    public function getUserInfo(Request $request){
        if($request->header('user-secure-key') && $request->username && $request->amount){
        $balance = getAmount(trim($request->amount));
        $userID = decrypt(trim($request->header('user-secure-key')));
        $userName = trim($request->username);
        $userData=User::select(['id','username','firstname','lastname','balance','status'])->where('id',$userID)->where('username',$userName)->first();
            if($userData){
                if($userData->status!=1){
                    return response()->json([
                      'status' => 200,
                      'message' =>'User is not active',
                    ],200);

                }else if($userData->balance < $balance){
                    return response()->json([
                      'status' => 200,
                      'message' =>'Insufficient balance',
                    ],200);

                }else{
                    if($request->act && $request->act==122075){
                        $process=$this->subtractUserBalance($userID,$balance);
                        return $process;
                    }else{
                       return response()->json([
                          'status' => 200,
                          'message' =>'success',
                          'data'    =>$userData->username.' is verified user and has required balance of '.$userData->balance.' AXT',
                        ],200);
                    }
                }
            }else{
                return response()->json([
                  'status' => 200,
                  'message' =>'Invalid user',
                ],200);
            }
        }else{
             return response()->json([
              'status' => 404,
              'message' =>'Payload is invalid',
            ],404);
        }

    }
    public function subtractUserBalance($id,$amount)
    {
        $user = User::findOrFail($id);
        $general = GeneralSetting::first(['cur_text','cur_sym']);
        $trx = getTrx();

        if ($amount <= $user->balance) {
            $user->balance -= $amount;
            $user->save();
            $transaction = new Transaction();
            $transaction->user_id = $user->id;
            $transaction->amount = $amount;
            $transaction->post_balance = getAmount($user->balance);
            $transaction->charge = 0;
            $transaction->trx_type = '-';
            $transaction->details = 'Subtract Balance Via stakeavante.org';
            $transaction->trx =  $trx;
            $transaction->save();
            if($transaction->id > 0){
                return response()->json([
                  'status' => 200,
                  'message' =>'success',
                  'data'=>'Auto approved by system'
                ],200);
            }else{
                return response()->json([
                  'status' => 200,
                  'message' =>'Auto rejected by system',
                ],200);
            }
        }else{
             return response()->json([
                      'status' => 200,
                      'message' =>'Insufficient balance',
                    ],200);
        }
    }
}

