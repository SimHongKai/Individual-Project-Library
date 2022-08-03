<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class BorrowHistory extends Model
{
    use HasFactory;
    protected $table = 'borrowhistory';
    protected $fillable = [
        'user_id',
        'material_no',
        'ISBN',
        'borrowed_at',
        'due_at', 
        'returned_at',
        'status',
        'created_by'
    ];
    public $timestamps = false;

    public function book(){
        return $this->belongsTo('App\Models\Book', 'ISBN', 'ISBN');
    }

    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
