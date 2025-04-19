<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;


class Usuario extends Authenticatable
{
    protected $table = 'usuario';
    protected $primaryKey = 'id_usuario';
    public $incrementing = false;

    protected $fillable = [
        'id_usuario',
        'nombre',
        'apellido',
        'correo',
        'contrasena',
        'telefono',
        'img_usuario',
        'condicion'
    ];
    public function getAuthPassword()
    {
        return $this->contrasena;
    }

    public function staff()
    {
    return $this->hasOne(Staff::class, 'id_usuario');
    }

}
