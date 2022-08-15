<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RewardHistory extends Model
{
    use HasFactory;
    protected $table = 'rewardhistory';
    protected $fillable = [
        'user_id',
        'reward_id',
        'name',
        'description',
        'points_required', 
        'status',
    ];
    public $timestamps = true;
}
