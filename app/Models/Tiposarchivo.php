<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tiposarchivo extends Model
{
    protected $table = 'tiposarchivos';
    protected $fillable =[
        'nombre',
        'estado',
    ];
    public $timestamps = false;

}
