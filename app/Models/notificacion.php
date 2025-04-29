<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class notificacion extends Model
{
    protected $table = 'notificaciones';
    public $timestamps = false;
    protected $primaryKey = 'id_notificacion';

    protected $fillable = [
        'id_cita',
        'titulo',
        'estado'
    ];

    public function cita()
    {
        return $this->belongsTo(Cita::class, 'id_cita');
    }
}
