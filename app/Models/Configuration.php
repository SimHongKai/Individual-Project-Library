<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    use HasFactory;
    protected $table = 'configurations';
    protected $fillable = [
        'no_of_borrows',
        'borrow_duration',
        'late_fees',
        'missing_fees'
    ];
}
