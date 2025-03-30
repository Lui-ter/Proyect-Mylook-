<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Establecimiento extends Model
{
    protected $table = 'establecimiento';
    protected $primaryKey = 'id_establc';
    public $timestamps = false;


    protected $fillable = [
        'id_establc',
        'id_negocio',
        'nombre_establc',
        'desc_establc',
        'ubicacion',
        'correo',
        'telefono'
    ];

    public function negocio()
    {
        return $this->belongsTo(Negocio::class, 'id_negocio');
    }
}
