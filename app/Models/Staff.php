<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = 'staff';
    protected $primaryKey = 'id_staff';
    public $timestamps = false;

    protected $fillable = [
        'id_usuario',
        'id_rol',
        'id_establc',
        'id_negocio',
        'estado'
    ];

    public function usuario(){
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }

    public function establecimiento(){
        return $this->belongsTo(Establecimiento::class, 'id_establc', 'id_establc');
    }

    public function rol(){
        return $this->belongsTo(Rol::class, 'id_rol', 'id_rol');
    }

    public function negocio(){
        return $this->belongsTo(Negocio::class, 'id_negocio', 'id_negocio');
    }
}
