<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Negocio extends Authenticatable
{
    protected $table = 'negocio';
    public $incrementing = false; // No auto-increment

    protected $fillable = [
        'id_negocio',
        'id_usuario',
        'nombre_negocio',
        'contrasena',
        'desc_negocio'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }
}
