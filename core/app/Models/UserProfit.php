<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class UserProfit extends Model
{    use HasFactory;
    protected $fillable = ['user_id', 'profit', 'amount'];
    
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user that received the profit
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Get user's profit for a specific date
     * 
     * @param int $userId
     * @param string $date Format: Y-m-d
     * @return UserProfit|null
     */
    public static function getUserProfitForDate($userId, $date = null)
    {
        $date = $date ?? Carbon::now()->format('Y-m-d');
        
        return self::where('user_id', $userId)
            ->whereDate('created_at', $date)
            ->first();
    }
    
    /**
     * Get user's expected profit for their current plan
     * 
     * @param int $userId
     * @return float|null
     */
    public static function getExpectedProfit($userId)
    {
        $user = User::find($userId);
        
        if (!$user || !$user->plan_id || $user->total_invest <= 0 || $user->plan_expiry <= Carbon::now()) {
            return null;
        }
        
        $plan = Plan::find($user->plan_id);
        
        if (!$plan) {
            return null;
        }
        
        // Calculate monthly profit
        $monthly_profit = ceil($user->total_invest * $plan->profit / 100);
        
        // Convert to daily profit
        $totalDays = Carbon::now()->daysInMonth;
        return round($monthly_profit / $totalDays, 2);
    }
    
    /**
     * Check if user already received profit today
     * 
     * @param int $userId
     * @return bool
     */
    public static function isToday($userId)
    {
        return self::where('user_id', $userId)
            ->whereDate('created_at', Carbon::now()->format('Y-m-d'))
            ->exists();
    }
}
