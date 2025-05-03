<?php

namespace App\Http\Controllers;

use App\Models\GeneralSetting;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserLogin;
use App\Models\Deposit;
use App\Models\Plan;
use App\Models\UserProfit;
use App\Models\Reward;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CronController extends Controller
{
    private $userModel;
    private $currentDateTime;
    private $currentDate;
    private $currentTime;
    private $cronTimeDate;
    public function __construct()
    {
        $this->currentDateTime= Carbon::now()->toDateTimeString();
        $this->currentDate = Carbon::now()->toDateString();
        $this->currentTime = Carbon::now()->toTimeString();
        $this->cronTimeDate =$this->currentDate.' 00:00:00';
        $this->userModel = new User();
    }
   public function giveRewards()
    {
        $firstRequired = null;
        $secondRequired = null;
        $thirdRequired = null;
        $fourthRequired = null;
        $fifthRequired = null;
        $sixthRequired = null;
        $seventhRequired = null;
        $firstMiddle = null;
        $secondMiddle = null;
        $thirdMiddle = null;
        $fourthMiddle = null;
        $fifthMiddle = null;
        $sixthMiddle = null;
        $seventhMiddle = null;
        $gnl = GeneralSetting::first();
        $reward1 = Reward::find(1);
        $reward2 = Reward::find(2);
        $reward3 = Reward::find(3);
        $reward4 = Reward::find(4);
        $reward5 = Reward::find(5);
        $reward6 = Reward::find(6);
        $reward7 = Reward::find(7);
        if($reward1 && $reward1->price > 0){
         $firstRequired = 1000;
         $firstMiddle = 1000;
        }
        if($reward2 && $reward2->price > 0){
         $secondRequired = 2500;
         $secondMiddle = 2500;
        }
        if($reward3 && $reward3->price > 0){
         $thirdRequired = 5000;
         $thirdMiddle = 5000;
        }
        if($reward4 && $reward4->price > 0){
         $fourthRequired = 10000;
         $fourthMiddle = 10000;
        }
        if($reward5 && $reward5->price > 0){
         $fifthRequired = 50000;
         $fifthMiddle = 50000;
        }
        if($reward6 && $reward6->price > 0){
         $sixthRequired = 100000;
         $sixthMiddle = 100000;
        }
        if($reward7 && $reward7->price > 0){
         $seventhRequired = 500000;
         $seventhMiddle = 500000;
        }
        if($this->isCron()){
            if($gnl->reward_status){
                //get all user with children
                $users = $this->userModel->getAllUsers();
                if($users){
                    foreach($users as $user){
        /** First Reward->if user has completed level 1**/
                        if($user->children_count==3 && $user->reward_one!=1){
                            if($this->userModel->getTotalSale($user->children[0]->id,$user->id) >= $firstRequired && $this->userModel->getTotalSale($user->children[1]->id,$user->id) >=$firstMiddle  && $this->userModel->getTotalSale($user->children[2]->id,$user->id) >=$firstRequired && $reward1!=null){
                            //Reward one function
                                $this->sendReward($user->id,$reward1->price,1,$reward1->name);
                            }
                        }
        /****Second Reward->when got first reward than**/
                        if($user->children_count==3 && $user->reward_one==1 && $user->reward_two!=1){
                           if($this->userModel->getTotalSale($user->children[0]->id,$user->id) >= $secondRequired && $this->userModel->getTotalSale($user->children[1]->id,$user->id) >=$secondMiddle && $this->userModel->getTotalSale($user->children[2]->id,$user->id) >=$secondRequired  && $reward2!=null){
                        //Reward second function
                                $this->sendReward($user->id,$reward2->price,2,$reward2->name);
                            }
                        }
        /*** Third Reward->when got second reward than***/
                        if($user->children_count==3 && $user->reward_one==1 && $user->reward_two==1 && $user->reward_three!=1){
                           if($this->userModel->getTotalSale($user->children[0]->id,$user->id) >= $thirdRequired && $this->userModel->getTotalSale($user->children[1]->id,$user->id) >=$thirdMiddle && $this->userModel->getTotalSale($user->children[2]->id,$user->id) >=$thirdRequired && $reward3!=null){
                        //Reward third function
                                $this->sendReward($user->id,$reward3->price,3,$reward3->name);
                            }
                        }
            /***Fourth Reward->when got third reward than***/
                        if($user->children_count==3 && $user->reward_one==1 && $user->reward_two==1 && $user->reward_three==1 && $user->reward_four!=1){
                           if($this->userModel->getTotalSale($user->children[0]->id,$user->id) >= $fourthRequired && $this->userModel->getTotalSale($user->children[1]->id,$user->id) >=$fourthMiddle && $this->userModel->getTotalSale($user->children[2]->id,$user->id) >=$fourthRequired  && $reward4!=null){
                        //Reward fourth function
                                $this->sendReward($user->id,$reward4->price,4,$reward4->name);
                            }
                        }
            /***Fifth Reward->when got fourth reward than***/
                        if($user->children_count==3 && $user->reward_one==1 && $user->reward_two==1 && $user->reward_three==1 && $user->reward_four==1 && $user->reward_five!=1){
                           if($this->userModel->getTotalSale($user->children[0]->id,$user->id) >= $fifthRequired && $this->userModel->getTotalSale($user->children[1]->id,$user->id) >=$fifthMiddle && $this->userModel->getTotalSale($user->children[2]->id,$user->id) >=$fifthRequired && $reward5!=null){
                        //Reward fifth function
                                $this->sendReward($user->id,$reward5->price,5,$reward5->name);
                            }
                        }
             /***Sixth Reward->when got fifth reward than***/
                        if($user->children_count==3 && $user->reward_one==1 && $user->reward_two==1 && $user->reward_three==1 && $user->reward_four==1 && $user->reward_five==1 && $user->reward_six!=1){
                           if($this->userModel->getTotalSale($user->children[0]->id,$user->id) >= $sixthRequired && $this->userModel->getTotalSale($user->children[1]->id,$user->id) >=$sixthMiddle && $this->userModel->getTotalSale($user->children[2]->id,$user->id) >=$sixthRequired && $reward6!=null){
                        //Reward sixth function
                                $this->sendReward($user->id,$reward6->price,6,$reward6->name);
                            }
                        }
              /***Seventh Reward->when got sixth reward than***/
                        if($user->children_count==3 && $user->reward_one==1 && $user->reward_two==1 && $user->reward_three==1 && $user->reward_four==1 && $user->reward_five==1 && $user->reward_six==1 && $user->reward_seven!=1){
                           if($this->userModel->getTotalSale($user->children[0]->id,$user->id) >= $seventhRequired && $this->userModel->getTotalSale($user->children[1]->id,$user->id) >=$seventhMiddle && $this->userModel->getTotalSale($user->children[2]->id,$user->id) >=$seventhRequired && $reward7!=null){
                        //Reward seventh function
                                $this->sendReward($user->id,$reward7->price,7,$reward7->name);
                            }
                        }
                    }
                }
            }
        }else{
            abort(404);
        }
    }
    public function giveProfit()
    {
        $totalMonthDays = Carbon::now()->daysInMonth;
        //$totalYearDays = Carbon::now()->daysInYear;
        $gnl = GeneralSetting::first();
        if($this->isCron()){
            if($gnl->profit_status){
                //get all user with children
                $users = $this->userModel->getAllUsersForProfit();
                if($users){
                    foreach($users as $user){
                        $plan = Plan::where('id',$user->plan_id)->first();
                        $todaydate= Carbon::now()->format('Y-m-d');
                        $profit = UserProfit::where('user_id',$user->id)->where('created_at','like',$todaydate.'%')->first();
                        if($profit){
                        $profitdate=Carbon::parse($profit->created_at)->format('Y-m-d');
                        }else{
                            $profitdate=null;
                        }
                        if($profit==null || $profitdate!=$todaydate){
                            $user_profit = ceil($user->total_invest*$plan->profit/100);
                            if($user_profit  > 0 && $user->plan_expiry > Carbon::now()){
                            $daily_profit = round($user_profit/$totalMonthDays,2);
                            $this->sendProfit($user->id,$daily_profit,$todaydate);
                            }
                        }
                    }
                }
            }
        }else{
            abort(404);
        }
    }
    public function deleteUnpaid(){
         dd('Deletion of user is disabled');
         echo 'saeed';
        $expiryDate=Carbon::now()->subDay(3);
        if($this->isCron()){
            //get all user with children
            $users = User::where('status',1)->where('plan_id',0)->where('created_at','<',$expiryDate)->where('balance','<',100)->where('plan_type',5)->get();
            if($users){
                foreach($users as $user){
                    $deposits = Deposit::where('status','<>',3)->where('user_id',$user->id)->first();
                    if($deposits){
                        //do nothing
                    }else{
                        $user->delete();
                        UserLogin::where('user_id',$user->id)->delete();
                    }
                }
            }
        }
    }
    public function makeExpire(){
        $gnl = GeneralSetting::first();
        $expiryDate=Carbon::now();
        if($this->isCron()){
            //get all user with expired plan
            $users = User::where('plan_id',1)->where('plan_expiry','<',$expiryDate)->get();
            if($users){
                foreach($users as $user){
                    $pastBalance=$user->total_invest;
                    $user->plan_id=0;
                    $user->plan_type=0;
                    $user->balance+=$user->total_invest;
                    $user->total_invest=0;
                    $user->update();
                    $trx = new Transaction();
                    $trx->user_id = $user->id;
                    $trx->amount = $user->total_invest;
                    $trx->charge = 0;
                    $trx->trx_type = '+';
                    $trx->post_balance = $user->balance;
                    $trx->remark = 'plan_expiry';
                    $trx->trx = getTrx();
                    $trx->details = 'Paid '.$pastBalance . ' ' . $gnl->cur_text . ' as plan investment return on '.$expiryDate; 
                    $trx->save();

                }
            }
        }
    }
    private function isCron(){
        if($this->currentDateTime > $this->cronTimeDate){
            return true;
        }
        else{
            //make it false if want to time fix
            return true;
        }
    }
    private function sendReward($userid,$bonus,$type,$reward=null){
        $gnl = GeneralSetting::first();
        $user = User::find($userid);
        $user->balance += $bonus;
        switch($type){
            case(1):
            $user->reward_one = 1;
            break;
            case(2):
            $user->reward_two = 1;
            break;
            case(3):
            $user->reward_three = 1;
            break;
            case(4):
            $user->reward_four = 1;
            break;
            case(5):
            $user->reward_five = 1;
            break;
            case(6):
            $user->reward_six = 1;
            break;
            case(7):
            $user->reward_seven = 1;
            break;
        }
        $user->save();
        $trx = new Transaction();
        $trx->user_id = $userid;
        $trx->amount = $bonus;
        $trx->charge = 0;
        $trx->trx_type = '+';
        $trx->post_balance = $user->balance;
        $trx->remark = 'bonus_commission';
        $trx->trx = getTrx();
        $trx->details = 'Paid ' . $bonus . ' ' . $gnl->cur_text . ' as reward of becoming  
        '.$reward;
        $trx->save();
        notify($user, 'matching_bonus', [
            'amount' => $bonus,
            'currency' => $gnl->cur_text,
            'paid_bv' => $bonus,
            'post_balance' => $user->balance,
            'trx' =>  $trx->trx,
        ]);
    }
    private function sendProfit($userid,$profit,$todaydate){
        $gnl = GeneralSetting::first();
        $user = User::find($userid);
        $user->balance += $profit;
        $user->save();
        //add user profit
        $uProfit = new UserProfit();
        $uProfit->user_id=$userid;
        $uProfit->profit = $profit;
        $uProfit->save();
        //update transaction
        $trx = new Transaction();
        $trx->user_id = $userid;
        $trx->amount = $profit;
        $trx->charge = 0;
        $trx->trx_type = '+';
        $trx->post_balance = $user->balance;
        $trx->remark = 'bonus_commission';
        $trx->trx = getTrx();
        $trx->details = 'Paid ' . $profit . ' ' . $gnl->cur_text . ' as profit of '.$todaydate;
        $trx->save();
        notify($user, 'matching_bonus', [
            'amount' => $profit,
            'currency' => $gnl->cur_text,
            'paid_bv' => $profit,
            'post_balance' => $user->balance,
            'trx' =>  $trx->trx,
        ]);
    }
}
