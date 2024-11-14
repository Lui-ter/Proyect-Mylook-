<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $table = 'servicio';
    protected $primaryKey = 'id_servicio';
    public $timestamps = false;

    protected $fillable = [
        'id_tiposerv',
        'nom_servicio',
        'desc_servicio',
        'img_serv',
        'duracion_serv',
        'precio_servicio'
    ];

    public function tipoServicio()
    {
        return $this->belongsTo(TipoServicio::class, 'id_tiposerv');
    }
}
