<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class BorrowHistory extends Model
{
    use HasFactory;
    protected $PL = null;
    protected $table = 'borrowhistory';
    protected $fillable = [
        'user_id',
        'material_no',
        'ISBN',
        'borrowed_at',
        'due_at',
        'returned_at',
        'late_fees',
        'status',
        'created_by'
    ];
    public $timestamps = false;
}
