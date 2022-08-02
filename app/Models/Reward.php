<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'rewards';
    protected $fillable = [
        'name',
        'description',
        'points_required'
    ];
    public $timestamps = true;
}
