<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $primaryKey = 'booking_id';
    protected $table = 'bookings';
    protected $fillable = [
        'user_id',
        'ISBN',
        'material_no',
        'status',
        'expire_at',
    ];
    public $timestamps = true;
}
