<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $primaryKey = 'ISBN';
    protected $table = 'books';
    protected $fillable = [
        'title',
        'description',
        'cover_img',
        'author', 
        'publication',
        'publication_date',
        'language',
        'price',
        'total_qty',
        'available_qty',
        'access_level'
    ];
    public $timestamps = true;
}
