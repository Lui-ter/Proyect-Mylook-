<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $table = 'servicio';
    protected $primaryKey = 'id_servicio';
    public $timestamps = false;

    protected $fillable = [
        'id_categoria',
        'nombre_servicio',
        'desc_servicio',
        'img_serv',
        'duracion_serv',
        'precio_servicio'
    ];

    public function Categoria(){
        return $this->belongsTo(Categoria::class, 'id_categoria', 'id_categoria');
    }

    public function reservas(){
        return $this->hasMany(ReservaServicio::class, 'id_servicio');
    }

}
