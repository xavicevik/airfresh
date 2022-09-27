<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipohistorial extends Model
{
    protected $table = 'tipohistorial';
    protected $fillable =[
        'nombre',
        'estado',
    ];

}
