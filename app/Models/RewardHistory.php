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
        'name',
        'description',
        'points_required', 
        'created_at'
    ];
    public $timestamps = false;
}
