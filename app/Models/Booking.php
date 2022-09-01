<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $table = 'bookings';
    protected $fillable = [
        'id',
        'user_id',
        'IBSN',
        'material_no',
        'status',
    ];
    public $timestamps = true;
}