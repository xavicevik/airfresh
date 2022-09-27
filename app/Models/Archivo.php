<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{
    protected $table = 'archivos';
    protected $fillable =[
        'idtipoarchivo',
        'nombre',
        'idmilitante',
        'url',
        'extension',
        'tamaño',
        'estado'
    ];

    public function tipoarchivo(){
        return $this->belongsTo(Tiposarchivo::class, 'idtipoarchivo');
    }

    public function militante(){
        return $this->belongsTo(Militante::class, 'idmilitante');
    }

}
