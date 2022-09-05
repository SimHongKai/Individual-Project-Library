<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;
    protected $primaryKey = 'material_no';
    protected $table = 'materials';
    protected $fillable = [
        'material_no',
        'ISBN',
        'call_no',
        'status'
    ];
    public $timestamps = true;
}
