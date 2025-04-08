<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Negocio extends Authenticatable
{
    protected $table = 'negocio';
    protected $primaryKey = 'id_negocio';
    public $incrementing = false; // No auto-increment
    public $timestamps = false;


    protected $fillable = [
        'id_negocio',
        'id_usuario',
        'nombre_negocio',
        'contrasena',
        'desc_negocio',
        'img_perfil',
        'img_portada'
    ];

    public function usuario(){
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }

    public function getAuthPassword(){
        return $this->contrasena;
    }
}
