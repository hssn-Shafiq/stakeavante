<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'address' => 'object',
        'ver_code_send_at' => 'datetime'
    ];

    protected $data = [
        'data'=>1
    ];




    public function login_logs()
    {
        return $this->hasMany(UserLogin::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class)->orderBy('id','desc');
    }

    public function deposits()
    {
        return $this->hasMany(Deposit::class)->where('status','!=',0);
    }

    public function withdrawals()
    {
        return $this->hasMany(Withdrawal::class)->where('status','!=',0);
    }
    public function userRef(){
       return $this->hasMany(User::class,'ref_id');
    }
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
    public function getToken(){
        return $this->hasOne(PasswordReset::class, 'email','email');
    }
    // SCOPES

    public function getFullnameAttribute()
    {
        return $this->firstname . ' ' . $this->lastname;
    }
    public function scopeWinner()
    {
        return $this->where('reward_one', 1)
        ->orWhere('reward_two',1)
        ->orWhere('reward_three',1)
        ->orWhere('reward_four',1)
        ->orWhere('reward_five',1)
        ->orWhere('reward_six',1)
        ->orWhere('reward_seven',1)
        ->orderBy('total_sale','DESC');
    }

    public function scopeActive()
    {
        return $this->where('status', 1);
    }

    public function scopeBanned()
    {
        return $this->where('status', 0);
    }
    public function scopeUnpaid()
    {
        return $this->where('status', 1)->where('plan_id',0);
    }

    public function scopeEmailUnverified()
    {
        return $this->where('ev', 0);
    }

    public function scopeSmsUnverified()
    {
        return $this->where('sv', 0);
    }
    public function scopeEmailVerified()
    {
        return $this->where('ev', 1);
    }

    public function scopeSmsVerified()
    {
        return $this->where('sv', 1);
    }
    public function parent()
    {
        return $this->belongsTo(User::class, 'ref_id');
    }

    public function children()
    {
        return $this->hasMany(User::class, 'ref_id','id')->where('plan_id','<>',0);
    }
    public function getAllUsers(){
      $users =  self::where('status',1)->where('plan_id','<>',0)->where('plan_type',1)->withCount('children')->get();
      return $nestable = self::nestable($users);
    }
    public function getAllUsersForProfit(){
      $users =  self::where('status',1)->where('plan_id','<>',0)->where('plan_type','<>',5)->withCount('children')->get();
      return $nestable = self::nestable($users);
    }
    public function getTreeUsers(){
      $users =  self::where('status',1)->withCount('children')->get();
      return $nestable = self::nestable($users);
    }
    public static function nestable($users) {
       foreach ($users as $user) {
           if (!$user->children->isEmpty()) {
               $user->children = self::nestable($user->children);
            }
        }
        return $users;
    }
    public function getTotalSale($id,$main){
        $currentUser = User::where('id',$id)->first();
        $membership = User::where('id',$main)->first();
        $count1 = User::where(function($query) use($id,$membership) {
            if($membership->membership_id==1){
             $query->orWhere('level1_parent', $id);
            }else if($membership->membership_id==2){
             $query->orWhere('level1_parent', $id)
             ->orWhere('level2_parent',$id);
            }else if($membership->membership_id==3){
             $query->orWhere('level1_parent', $id)
             ->orWhere('level2_parent',$id)
             ->orWhere('level3_parent',$id);
            }else if($membership->membership_id==4){
             $query->orWhere('level1_parent', $id)
             ->orWhere('level2_parent',$id)
             ->orWhere('level3_parent',$id)
             ->orWhere('level4_parent',$id);
            }else if($membership->membership_id==5){
             $query->orWhere('level1_parent', $id)
             ->orWhere('level2_parent',$id)
             ->orWhere('level3_parent',$id)
             ->orWhere('level4_parent',$id)
             ->orWhere('level5_parent',$id);
            }else if($membership->membership_id==6){
             $query->orWhere('level1_parent', $id)
             ->orWhere('level2_parent',$id)
             ->orWhere('level3_parent',$id)
             ->orWhere('level4_parent',$id)
             ->orWhere('level5_parent',$id)
             ->orWhere('level6_parent',$id);
            }else if($membership->membership_id==7){
            $query->orWhere('level1_parent', $id)
              ->orWhere('level2_parent',$id)
              ->orWhere('level3_parent',$id)
              ->orWhere('level4_parent',$id)
              ->orWhere('level5_parent',$id)
              ->orWhere('level6_parent',$id)
              ->orWhere('level7_parent',$id);
            }})->where('plan_type',1)->sum('total_invest');
        if($currentUser->plan_type==1){
            $count2 = $currentUser->total_invest;
        }else{
            $count2=0;
        }
        return $count = $count1+$count2;

    }
     public static function getTotalSaleInner($id,$type=null,$main=null){
        $currentUser = User::where('id',$id)->first();
        if($main!=null){
        $membership = User::where('id',$main)->first();
        }else{
        $membership = User::where('id',$id)->first();
        }
        $count1 = User::where(function($query) use($id,$membership) {
            if($membership->membership_id==1){
             $query->orWhere('level1_parent', $id);
            }else if($membership->membership_id==2){
             $query->orWhere('level1_parent', $id)
             ->orWhere('level2_parent',$id);
            }else if($membership->membership_id==3){
             $query->orWhere('level1_parent', $id)
             ->orWhere('level2_parent',$id)
             ->orWhere('level3_parent',$id);
            }else if($membership->membership_id==4){
             $query->orWhere('level1_parent', $id)
             ->orWhere('level2_parent',$id)
             ->orWhere('level3_parent',$id)
             ->orWhere('level4_parent',$id);
            }else if($membership->membership_id==5){
             $query->orWhere('level1_parent', $id)
             ->orWhere('level2_parent',$id)
             ->orWhere('level3_parent',$id)
             ->orWhere('level4_parent',$id)
             ->orWhere('level5_parent',$id);
            }else if($membership->membership_id==6){
             $query->orWhere('level1_parent', $id)
             ->orWhere('level2_parent',$id)
             ->orWhere('level3_parent',$id)
             ->orWhere('level4_parent',$id)
             ->orWhere('level5_parent',$id)
             ->orWhere('level6_parent',$id);
            }else if($membership->membership_id==7){
            $query->orWhere('level1_parent', $id)
              ->orWhere('level2_parent',$id)
              ->orWhere('level3_parent',$id)
              ->orWhere('level4_parent',$id)
              ->orWhere('level5_parent',$id)
              ->orWhere('level6_parent',$id)
              ->orWhere('level7_parent',$id);
            }else{
              $query->orWhere('id',$id);
            }})->where('plan_type',1)->sum('total_invest');
        if($currentUser->plan_type==1){
            $count2 = $currentUser->total_invest;
        }else{
            $count2=0;
        }
        if($type==1){
            return $count = $count1;
        }else{
            return $count = $count1+$count2;
        }
    }
}
