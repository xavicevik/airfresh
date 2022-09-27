<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Corporacion extends Model
{
    protected $table = 'corporaciones';
    protected $fillable =[
        'nombre',
        'estado',
    ];

}
