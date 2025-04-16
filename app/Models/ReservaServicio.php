<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservaServicio extends Model
{
    protected $table = 'reserva_servicio';
    public $incrementing = false;
    protected $primaryKey = ['id_cita', 'id_servicio'];
    public $timestamps = false;

    protected $fillable = [
        'id_cita',
        'id_servicio'
    ];

    public function cita()
    {
        return $this->belongsTo(Cita::class, 'id_cita');
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class, 'id_servicio');
    }
}
