<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    use HasFactory;
    protected $primaryKey = 'privilege';
    protected $table = 'configurations';
    protected $fillable = [
        'no_of_borrows',
        'borrow_duration',
        'late_fees_base',
        'late_fees_increment',
        'point_limit',
    ];
}
