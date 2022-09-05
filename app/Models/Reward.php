<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    use HasFactory;
    protected $primaryKey = 'reward_id';
    protected $table = 'rewards';
    protected $fillable = [
        'name',
        'description',
        'points_required',
        'available_qty',
        'reward_img',
    ];
    public $timestamps = true;
}
