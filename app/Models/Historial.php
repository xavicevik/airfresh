<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historial extends Model
{
    protected $table = 'historial';
    protected $fillable =[
        'idmilitante',
        'idtipohistorial',
        'idusuario',
        'observaciones',
    ];

    public function militante() {
        return $this->hasMany(Militante::class, 'idmilitante');
    }
    public function tipo(){
        return $this->belongsTo(Tipohistorial::class, 'idtipohistorial');
    }

    public function usuario(){
        return $this->belongsTo(User::class, 'idusuario');
    }

}
