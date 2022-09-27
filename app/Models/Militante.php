<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Casts\Attribute;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;


class Militante extends Authenticatable implements Auditable
{
    use AuditableTrait;
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    protected $guard = 'militantes';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'nombre', 'correo', 'username','password', 'apellido', 'idtipos_documento', 'estado',
        'documento', 'direccion', 'idpais', 'iddepartamento', 'idciudad', 'observaciones',
        'telefono', 'movil', 'changedpassword', 'telefono', 'fechaingreso', 'idinscripcion',
        'fechanacimiento', 'idgenero', 'idniveleducativo', 'discapacitado', 'victimaconflicto',
        'idgrupoetnico', 'lider', 'avalado', 'idcorporacion', 'periodo', 'electo', 'votos',
        'coalicion', 'nombrecoalicion','renuncio', 'fecharenuncia', 'aval', 'idremplazo',
        'facebook', 'instagram', 'twitter', 'ccestado','ccreposicion', 'ccobservaciones',
        'cccreated_at', 'ccupdated_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url', 'full_name'
    ];

    public function historial() {
        return $this->hasMany(Historial::class, 'idmilitante');
    }

    public function genero(){
        return $this->belongsTo(Genero::class, 'idgenero');
    }

    public function niveleducativo(){
        return $this->belongsTo(Niveleducativo::class, 'idniveleducativo');
    }

    public function grupoEtnico(){
        return $this->belongsTo(Grupoetnico::class, 'idgrupoetnico');
    }

    public function estados(){
        return $this->belongsTo(Estado::class, 'estado');
    }

    public function tipoinscripcion(){
        return $this->belongsTo(Tipoinscripcion::class, 'idinscripcion');
    }

    public function corporacion(){
        return $this->belongsTo(Corporacion::class, 'idcorporacion');
    }

    public function remplazo(){
        return $this->belongsTo(Militante::class, 'idremplazo');
    }

    public function archivos() {
        return $this->hasMany(Archivo::class, 'idmilitante');
    }

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'idrol');
    }

    public function tipodocumento()
    {
        return $this->belongsTo(TiposDocumento::class, 'idtipos_documento');
    }

    public function inscripcion()
    {
        return $this->belongsTo(Tipoinscripcion::class, 'idinscripcion');
    }

    public function pais(){
        return $this->belongsTo(Pais::class, 'idpais');
    }

    public function departamento(){
        return $this->belongsTo(Departamento::class, 'iddepartamento');
    }

    public function ciudad(){
        return $this->belongsTo(Ciudad::class, 'idciudad');
    }

    public function AllPermissions(): Attribute {
        $permissions = [];
        foreach ($this->getAllPermissions() as $permission) {
                $permissions[] = $permission->name;
        }
        return Attribute::make (
            get: fn () => $permissions,
        );
    }

    public function getFullNameAttribute()
    {
        return ucwords("{$this->nombre} {$this->apellido}");
    }
}
