<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    protected $table = 'cita';
    protected $primaryKey = 'id_cita';

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
}
