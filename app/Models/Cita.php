<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Cita extends Model
{
    protected $table = 'cita';
    protected $primaryKey = 'id_cita';
    public $timestamps = false;
    protected $fillable = [
        'id_usuario',
        'id_establc',
        'id_staff',
        'fecha_cita',
        'hora_cita',
        'duracion_cita',
        'estado_cita'
    ];

    public function usuario(){
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }

    public function establecimiento(){
        return $this->belongsTo(Establecimiento::class, 'id_establc', 'id_establc');
    }

    public function staff(){
        return $this->belongsTo(Staff::class, 'id_staff', 'id_staff');
    }

    public function reservaServicio(){
        return $this->hasOne(ReservaServicio::class, 'id_cita');
    }

    public function reservaProducto(){
        return $this->hasOne(ReservaProducto::class, 'id_cita');
    }

    public function notificacion(){
        return $this->hasMany(Notificacion::class, 'id_cita', 'id_cita');
    }

    public function Valoracion(){
        return $this->hasMany(Valoracion::class, 'id_cita', 'id_cita');
    }
}
