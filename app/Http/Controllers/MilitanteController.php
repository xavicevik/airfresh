<?php

namespace App\Http\Controllers;

use App\Exports\ClientesExport;
use App\Exports\MilitantesExport;
use App\Exports\UsersExport;
use App\Models\Archivo;
use App\Models\Audits;
use App\Models\Historial;
use App\Models\Imagen;
use App\Models\Militante;
use App\Models\Confcomision;
use App\Models\Puntoventa;
use App\Models\Rifa;
use App\Models\Rol;
use App\Models\Tiposarchivo;
use App\Models\User;
use App\Models\Vendedor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Laravel\Jetstream\Jetstream;
use Maatwebsite\Excel\Facades\Excel;
use OwenIt\Auditing\Models\Audit;
use Spatie\Permission\Models\Role;

use Illuminate\Support\Facades\Http;

class MilitanteController extends Controller
{
    const canPorPagina = 15;
    const nuCreacion = 1;
    const nuModificacion = 2;
    const nuSancion = 3;
    const nuEliminacion = 4;
    const nuRenuncia = 5;
    const nuRemplazo = 6;
    const nuAprobacion = 7;
    const nuSolicitudcc = 9;
    const nuReposicioncc = 10;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $buscar = $request->buscar;
        $filtros = json_decode($request->filtros);

        if ($request->has('sortBy') && $request->sortBy <> ''){
            $sortBy = $request->sortBy;
        } else {
            $sortBy = 'id';
        }

        if ($request->has('sortOrder') && $request->sortOrder <> ''){
            $sortOrder = $request->sortOrder;
        } else {
            $sortOrder = 'desc';
        }

        $militantes = Militante::orderBy($sortBy, $sortOrder)
                                ->with('genero')
                                ->with('tipoinscripcion')
                                ->with('niveleducativo')
                                ->with('grupoetnico')
                                ->with('departamento')
                                ->with('ciudad')
                                ->with('estados')
                                ->with('remplazo')
                                ->with('corporacion')
                                ->with('tipodocumento')
                                ->with('archivos.tipoarchivo');

        if ($buscar <> '') {
            $militantes = $militantes
                        ->where('nombre', 'like', '%'. $buscar . '%')
                        ->orWhere('apellido', 'like', '%'. $buscar . '%')
                        ->orWhere('correo', 'like', '%'. $buscar . '%')
                        ->orWhere('documento', 'like', '%'. $buscar . '%');
        }

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
            if (!is_null($filtros->estado) && $filtros->estado <> '' && $filtros->estado <> '-') {
                $militantes = $militantes->where('estado', $filtros->estado);
            }
        }

        $militantes = $militantes->paginate(self::canPorPagina);

        if ($request->has('ispage') && $request->ispage){
            return ['militantes' => $militantes];
        } else {
            return Inertia::render('Militantes/Index', ['militantes' => $militantes, '_token' => csrf_token()]);
        }
    }

    public function indexAuditoria(Request $request)
    {
        $buscar = $request->buscar;
        $filtros = json_decode($request->filtros);

        if ($request->has('sortBy') && $request->sortBy <> ''){
            $sortBy = $request->sortBy;
        } else {
            $sortBy = 'id';
        }

        if ($request->has('sortOrder') && $request->sortOrder <> ''){
            $sortOrder = $request->sortOrder;
        } else {
            $sortOrder = 'desc';
        }

        $auditorias = Audit::orderBy($sortBy, $sortOrder)
                             ->join('users', 'user_id', 'users.id')
                             ->join('militantes', 'auditable_id', 'militantes.id')
                             ->select('audits.*', 'users.nombre AS nombreusuario', 'users.apellido AS apellidousuario',
                                      'militantes.nombre AS nombremilitante', 'militantes.apellido AS apellidomilitante');

        if ($buscar <> '') {
            $auditorias = $auditorias
                ->where('nombre', 'like', '%'. $buscar . '%')
                ->orWhere('apellido', 'like', '%'. $buscar . '%')
                ->orWhere('correo', 'like', '%'. $buscar . '%')
                ->orWhere('documento', 'like', '%'. $buscar . '%');
        }

        if (!is_null($filtros)) {
            if(!is_null($filtros->fechainicio) && $filtros->fechainicio <> '' && $filtros->fechainicio <> null) {
                $auditorias = $auditorias->where('audits.updated_at', '>=', $filtros->fechainicio);
            }
            if(!is_null($filtros->fechafin) && $filtros->fechafin <> '' && $filtros->fechafin <> null) {
                $auditorias = $auditorias->where('audits.updated_at', '<=', $filtros->fechafin);
            }
            if(!is_null($filtros->usuario) && $filtros->usuario <> '-') {
                $auditorias = $auditorias->join('users as t1', 'audits.user_id', '=', 't1.id')
                    ->where('t1.nombre', 'like', '%'.$filtros->usuario.'%')
                    ->orWhere('t1.apellido', 'like', '%'.$filtros->usuario.'%')
                    ->orWhere('t1.documento', 'like', '%'.$filtros->usuario.'%');
            }
            if(!is_null($filtros->militante) && $filtros->militante <> '-') {
                $auditorias = $auditorias->join('militantes as t2', 'audits.auditable_id', '=', 't2.id')
                    ->where('t2.nombre', 'like', '%'.$filtros->militante.'%')
                    ->orWhere('t2.apellido', 'like', '%'.$filtros->militante.'%')
                    ->orWhere('t2.documento', 'like', '%'.$filtros->militante.'%');
            }
            if (!is_null($filtros->evento) && $filtros->evento <> '-') {
                $auditorias = $auditorias->where('event', $filtros->evento);
            }
        }

        $auditorias = $auditorias->paginate(self::canPorPagina);

        if ($request->has('ispage') && $request->ispage){
            return ['auditorias' => $auditorias];
        } else {
            return Inertia::render('Militantes/Indexauditoria', ['auditorias' => $auditorias, '_token' => csrf_token()]);
        }
    }

    public function getHistorial(Request $request)
    {
        $historial = Historial::where('idmilitante', $request->idmilitante)
                        ->with('usuario')
                        ->with('tipo')
                        ->orderby('updated_at', 'desc')
                        ->paginate(self::canPorPagina);

        return ['historial' => $historial];
    }

    public function getArchivos(Request $request)
    {
        $archivos =  Archivo::where('idmilitante', $request->idmilitante)
                              ->with('tipoarchivo')
                              ->get();

        return ['archivos' => $archivos];
    }

    public function archivoupload(Request $request) {
        try{
            DB::beginTransaction();

            $allowedfileExtension = ['pdf','jpg','png','docx', 'doc', 'xls', 'xlsx'];
            $codigo = 1;

            if(isset($request->file)){
                $file = $request->file;
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $check = in_array($extension, $allowedfileExtension);

                if($check) {
                    $archivo = new Archivo();
                    $archivo->idtipoarchivo = $request->idtipoarchivo;
                    $archivo->idmilitante = $request->idmilitante;
                    $archivo->nombre = $filename;
                    $archivo->url = url('/storage/archivos/').'/'.time(). '_' . $filename;
                    $archivo->extension = $extension;
                    $path = $file->move(public_path('/storage/archivos/'), $archivo->url);
                    $archivo->tamaño = $path->getSize();
                    $archivo->save();
                } else {
                    $codigo = -1;
                    $mensaje = 'La extensión de al menos un archivo no es permitida';
                }
            }

            if ($codigo == -1) {
                DB::rollBack();
            } else {
                DB::commit();
            }

            $mensaje = 'Archivo actualizado';
        } catch (Throwable $e){
            DB::rollBack();

            $codigo = -1;
            $mensaje = 'Se ha presentado un error';
        }
        return redirect()->back()->with('message', $mensaje);
        //return ['codigo' => $codigo, 'mensaje' => $mensaje];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $observaciones = 'Se ha creado el militante';
        Validator::make($request->all(), [
            'nombre' => ['required', 'string', 'max:255'],
            'apellido' => ['required', 'string', 'max:255'],
            'correo' => ['required', 'string', 'email', 'max:255'],
            'movil' => ['required', 'string', 'max:255'],
            'documento' => ['required', 'string', 'max:255'],
            'idtipos_documento' => 'required|numeric|gt:0',
            'iddepartamento' => 'required|numeric|gt:0',
            'idciudad' => 'required|numeric|gt:0',
            'idinscripcion' => 'required|numeric|gt:0',
            'idgenero' => 'required|numeric',
            'idniveleducativo' => 'required|numeric',
            'idgrupoetnico' => 'required|numeric',
        ],
            [
                'nombre.required' => 'Ingrese el nombre',
                'apellido.required' => 'Ingrese el apellido',
                'correo.required' => 'Ingrese el correo',
                'movil.required' => 'Ingrese el teléfono celular',
                'documento.required' => 'Ingrese el número de identificacion',
                'idtipos_documento.numeric' => 'Seleccione un tipo de documento',
                'iddepartamento.numeric' => 'Seleccione un Departamento',
                'idciudad.numeric' => 'Seleccione una ciudad',
                'idinscripcion.numeric' => 'Seleccione la inscripción',
                'idgenero.numeric' => 'Seleccione un género',
                'idniveleducativo.numeric' => 'Seleccione el nivel educativo',
                'idgrupoetnico.numeric' => 'Seleccione un grupo étnico',
            ])->validate();

        $militante = Militante::create($request->all());
        $militante->password = Hash::make($militante->password);
        $militante->estado = 3;
        $militante->saveOrFail();

        $this->setHistorial($militante->id, self::nuCreacion, $observaciones);

        return redirect()->back()->with('message', 'Militante creado satisfactoriamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Militante $militante)
    {
        $estadorenuncia = $militante->renuncio;
        try{
            DB::beginTransaction();
            $observaciones = 'El militante ha sido actualizado';
            Validator::make($request->all(), [
                'nombre' => ['required', 'string', 'max:255'],
                'apellido' => ['required', 'string', 'max:255'],
                'correo' => ['required', 'string', 'email', 'max:255'],
                'movil' => ['required', 'string', 'max:255'],
                'documento' => ['required', 'string', 'max:255'],
                'idtipos_documento' => 'required|numeric|gt:0',
                'iddepartamento' => 'required|numeric|gt:0',
                'idciudad' => 'required|numeric|gt:0',
                'idinscripcion' => 'required|numeric|gt:0',
                'idgenero' => 'required|numeric',
                'idniveleducativo' => 'required|numeric',
                'idgrupoetnico' => 'required|numeric',
            ],
                [
                    'nombre.required' => 'Ingrese el nombre',
                    'apellido.required' => 'Ingrese el apellido',
                    'correo.required' => 'Ingrese el correo',
                    'movil.required' => 'Ingrese el teléfono celular',
                    'documento.required' => 'Ingrese el número de identificacion',
                    'idtipos_documento.numeric' => 'Seleccione un tipo de documento',
                    'iddepartamento.numeric' => 'Seleccione un Departamento',
                    'idciudad.numeric' => 'Seleccione una ciudad',
                    'idinscripcion.numeric' => 'Seleccione la inscripción',
                    'idgenero.numeric' => 'Seleccione un género',
                    'idniveleducativo.numeric' => 'Seleccione el nivel educativo',
                    'idgrupoetnico.numeric' => 'Seleccione un grupo étnico',
                ])->validate();

            $militante->update($request->all());
            $this->setHistorial($militante->id, self::nuModificacion, $observaciones);
            if ($militante->renuncio == 1 && $estadorenuncia == 0) {
                $this->setRenuncia($militante);
            }
            DB::commit();

            return redirect()->back()->with('message', 'Usuario modificado satisfactoriamente');

        } catch (Throwable $e){
            DB::rollBack();

            return redirect()->back()->with('message', 'Error');
        }
    }

    public function updateEstado(Request $request, Militante $militante)
    {
        try{
            DB::beginTransaction();

            if ($request->tipo == 'sancionar') {
                $tipo = self::nuSancion;
                $estado = 11;
            } elseif ($request->tipo == 'aprobar') {
                $tipo = self::nuAprobacion;
                $estado = 1;
            } elseif ($request->tipo == 'eliminar') {
                $tipo = self::nuEliminacion;
                $estado = 10;
            }

            $militante->estado = $estado;
            $militante->save();
            $this->setHistorial($militante->id, $tipo, $request->observaciones);
            DB::commit();

            return redirect()->back()->with('message', 'Usuario modificado satisfactoriamente');

        } catch (Throwable $e){
            DB::rollBack();

            return redirect()->back()->with('message', 'Erro');
        }
    }

    public function ccupdate(Request $request, Militante $militante)
    {
        try{
            DB::beginTransaction();

            if ($request->tipo == 'solicitar') {
                $tipo = self::nuSolicitudcc;
                $estado = 3;
                $militante->cccreated_at = $request->cccreated_at;
            } elseif ($request->tipo == 'reposicion') {
                $tipo = self::nuReposicioncc;
                $estado = 1;
                $militante->ccupdated_at = $request->ccupdated_at;
                $militante->ccreposicion = $request->ccreposicion;

            }

            $militante->ccestado = $estado;
            $militante->ccobservaciones = $militante->ccobservaciones." \n".$request->ccobservaciones;
            $militante->save();
            $this->setHistorial($militante->id, $tipo, $request->ccobservaciones);
            DB::commit();

            return redirect()->back()->with('message', 'Usuario modificado satisfactoriamente');

        } catch (Throwable $e){
            DB::rollBack();

            return redirect()->back()->with('message', 'Erro');
        }
    }

    public function registroHistorial(Request $request) {
        $this->setHistorial($request->id, $request->tipo, $request->observaciones);

        return redirect()->back()->with('message', 'Usuario modificado satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if ($request->idrol == 2) {
            $user = Cliente::where('id', $request->id)->first();
        } elseif ($request->idrol == 5) {
            $user = Vendedor::where('id', $request->id)->first();
        } else {
            $user = User::where('id', $request->id)->first();
        }

        $user->estado = !$user->estado;
        $user->save();

        return redirect()->back()->with('message', 'Usuario modificado satisfactoriamente');
    }

    public function MilitantesExport(Request $request)
    {
        return Excel::download(new MilitantesExport($request), 'militantes.xlsx');
    }

    public function UsersExport(Request $request)
    {
        return Excel::download(new UsersExport($request), 'users.xlsx');
    }

    public function ClientesExport(Request $request)
    {
        return Excel::download(new ClientesExport($request), 'clientes.xlsx');
    }

    private function setRenuncia(Militante $renuncia) {
        $remplazo = Militante::where('id', $renuncia->idremplazo)->first();
        $remplazo->avalado = $renuncia->avalado;
        $remplazo->idcorporacion = $renuncia->idcorporacion;
        $remplazo->periodo = $renuncia->periodo;
        $remplazo->electo = $renuncia->electo;
        $remplazo->votos = $renuncia->votos;
        $remplazo->coalicion = $renuncia->coalicion;
        $remplazo->nombrecoalicion = $renuncia->nombrecoalicion;
        $remplazo->observaciones = $remplazo->observaciones.' - Remplazo de '.$renuncia->documento;
        $remplazo->save();
        $this->setHistorial($remplazo->id, self::nuRemplazo, 'Remplazo');

        $renuncia->avalado = 0;
        $renuncia->idcorporacion = null;
        $renuncia->periodo = null;
        $renuncia->electo = 0;
        $renuncia->votos = null;
        $renuncia->coalicion = 0;
        $renuncia->nombrecoalicion = null;
        $renuncia->save();
        $this->setHistorial($renuncia->id, self::nuRenuncia, 'Renunció');
    }

    private function setHistorial(int $idmilitante, int $idtipohistorial, string $observaciones) {
        $historial = new Historial();
        $historial->idmilitante = $idmilitante;
        $historial->idtipohistorial = $idtipohistorial;
        $historial->idusuario = Auth::user()->id;
        $historial->observaciones = $observaciones;
        $historial->save();
    }

}
