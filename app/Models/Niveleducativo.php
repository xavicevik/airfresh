<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Niveleducativo extends Model
{
    protected $table = 'niveleducativo';
    protected $fillable =[
        'nombre',
        'estado',
    ];

}
