<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuario';
    protected $primaryKey = 'id_usuario';
    public $incrementing = false;

    protected $fillable = [
        'nombre',
        'apellido',
        'correo',
        'contrasena',
        'telefono',
        'condicion'
    ];
}
