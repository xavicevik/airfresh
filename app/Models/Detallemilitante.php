<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detallemilitante extends Model
{
    protected $table = 'detallemilitante';
    protected $fillable =[
        'idmilitante',
        'idcorporacion',
        'periodo',
        'electo',
        'votos',
        'coalicion',
        'nombrecoalicion',
        'renuncio',
        'fecharenuncia',
        'idremplazo',
        'observaciones'
    ];

    public function corporacion(){
        return $this->belongsTo(Corporacion::class, 'idcorporacion');
    }

    public function militante(){
        return $this->belongsTo(Militante::class, 'idmilitante');
    }

    public function remplazo(){
        return $this->belongsTo(Militante::class, 'idremplazo');
    }
}
