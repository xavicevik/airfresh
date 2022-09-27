<?php

namespace App\Exports;

use App\Models\Boleta;
use App\Models\Militante;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class MilitantesExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $filtros = json_decode($this->request['filtros']);

        $militantes = Militante::join('generos', 'militantes.idgenero', '=', 'generos.id')
            ->leftJoin('militantes as remplazo', 'militantes.idremplazo', '=', 'remplazo.id')
            ->leftJoin('tipoinscripcions', 'militantes.idinscripcion', '=', 'tipoinscripcions.id')
            ->leftJoin('niveleducativo', 'militantes.idniveleducativo', '=', 'niveleducativo.id')
            ->leftJoin('grupoetnico', 'militantes.idgrupoetnico', '=', 'grupoetnico.id')
            ->leftJoin('departamentos', 'militantes.iddepartamento', '=', 'departamentos.id')
            ->leftJoin('ciudades', 'militantes.idciudad', '=', 'ciudades.id')
            ->leftJoin('corporaciones', 'militantes.idcorporacion', '=', 'corporaciones.id');

        if (!is_null($filtros)) {
            if(!is_null($filtros->fechainicio) && $filtros->fechainicio <> '' && $filtros->fechainicio <> null) {
                $militantes = $militantes->where('fechaingreso', '>=', $filtros->fechainicio);
            }
            if(!is_null($filtros->fechafin) && $filtros->fechafin <> '' && $filtros->fechafin <> null) {
                $militantes = $militantes->where('fechaingreso', '<=', $filtros->fechafin);
            }
            if (!is_null($filtros->documento) && $filtros->documento <> '') {
                $militantes = $militantes->where('documento', 'like', '%' . $filtros->documento . '%');
            }
            if (!is_null($filtros->nombre) && $filtros->nombre <> '') {
                $militantes = $militantes->where('nombre', 'like', '%' . $filtros->nombre . '%')
                    ->orWhere('apellido', 'like', '%' . $filtros->nombre . '%');
            }
            if (!is_null($filtros->correo) && $filtros->correo <> '') {
                $militantes = $militantes->where('correo', 'like', '%' . $filtros->correo . '%');
            }
            if (!is_null($filtros->movil) && $filtros->movil <> '') {
                $militantes = $militantes->where('movil', 'like', '%' . $filtros->movil . '%');
            }
            if(!is_null($filtros->idciudad) && $filtros->idciudad <> '') {
                $ciudades = $filtros->idciudad;
                $militantes = $militantes->whereHas('ciudad', function($query) use ($ciudades) {
                    $query->where('nombre', 'like', '%'.$ciudades.'%');
                });
            }
            if (!is_null($filtros->idinscripcion) && $filtros->idinscripcion <> '-' && $filtros->idinscripcion <> 0) {
                $militantes = $militantes->where('idinscripcion', $filtros->idinscripcion);
            }
            if (!is_null($filtros->idgenero) && $filtros->idgenero <> '-' && $filtros->idgenero <> 0) {
                $militantes = $militantes->where('idgenero', $filtros->idgenero);
            }
            if (!is_null($filtros->idgrupoetnico) && $filtros->idgrupoetnico <> '-' && $filtros->idgrupoetnico <> 0) {
                $militantes = $militantes->where('idgrupoetnico', $filtros->idgrupoetnico);
            }
            if (!is_null($filtros->idcorporacion) && $filtros->idcorporacion <> '-' && $filtros->idcorporacion <> 0 && $filtros->idcorporacion <> null) {
                $militantes = $militantes->where('idcorporacion', $filtros->idcorporacion);
            }
            if (!is_null($filtros->lider) && $filtros->lider <> '' && $filtros->lider <> '-') {
                $militantes = $militantes->where('lider', $filtros->lider);
            }
            if (!is_null($filtros->avalado) && $filtros->avalado <> '' && $filtros->avalado <> '-') {
                $militantes = $militantes->where('avalado', $filtros->avalado);
            }
            if (!is_null($filtros->electo) && $filtros->electo <> '' && $filtros->electo <> '-') {
                $militantes = $militantes->where('electo', $filtros->electo);
            }
        }

        return $militantes->select('militantes.fechaingreso as fechaingreso',
            'militantes.documento as documento',
            'militantes.nombre as nombre',
            'militantes.apellido as apellido',
            'militantes.correo as correo',
            'militantes.movil as movil',
            'militantes.direccion as direccion',
            'ciudades.nombre as ciudad',
            'departamentos.nombre as departamento',
            'militantes.observaciones as observaciones',
            'tipoinscripcions.nombre as tipoinscripcion',
            'generos.nombre as genero',
            'niveleducativo.nombre as niveleducativo',

            'militantes.discapacitado as discapacitado',
            'militantes.victimaconflicto as victimaconflicto',
            'grupoetnico.nombre as grupoetnico',
            'militantes.lider as lider',
            'militantes.avalado as avalado',
            'corporaciones.nombre as corporaciones',

            'militantes.periodo as periodo',
            'militantes.electo as electo',
            'militantes.votos as votos',
            'militantes.coalicion as coalicion',
            'militantes.nombrecoalicion as nombrecoalicion',
            'militantes.renuncio as renuncio',
            'militantes.fecharenuncia as fecharenuncia',
            'remplazo.documento as documentoremplazo',
            'remplazo.nombre as nombreremplazo',
            'remplazo.apellido as apellidoremplazo',

            'militantes.created_at as fecha_creacion',
            'militantes.updated_at as fecha_ultima_modificacion')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Fechaingreso',
            'Documento',
            'Nombre',
            'Apellido',
            'Correo',
            'Movil',
            'Dirección',
            'Ciudad',
            'Departamento',
            'Observacion',
            'Inscripción',
            'Género',
            'Nivel_Educativo',

            'Discapacitado',
            'Víctima',
            'Grupo Étnico',
            'Líder',
            'Avalado',
            'Corporaciones',
            'Periodo',

            'Electo',
            'Votos',
            'Coalición',
            'Nombre_Coalición',
            'Renunció',
            'Fecha_renuncia',
            'Documento_remplazo',
            'Nombre_remplazo',
            'Apellido_remplazo',

            'Fecha_creacion',
            'Fecha_ultima_actualizacion'
        ];
    }
}
