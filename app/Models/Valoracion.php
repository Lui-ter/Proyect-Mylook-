<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Valoracion extends Model
{
    protected $table = 'valoracion';
    protected $primaryKey = 'id_valoracion';

    protected $fillable = [
        'id_cita',
        'comentario',
        'calificacion'
    ];

    public function cita()
    {
        return $this->belongsTo(Cita::class, 'id_cita');
    }
}
