<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupoetnico extends Model
{
    protected $table = 'grupoetnico';
    protected $fillable =[
        'nombre',
        'estado',
    ];

}
