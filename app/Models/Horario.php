<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $table = 'horario';
    protected $primaryKey = 'id_horario';

    protected $fillable = [
        'id_establc',
        'id_staff',
        'hora_entrada',
        'hora_salida'
    ];

    public function establecimiento()
    {
        return $this->belongsTo(Establecimiento::class, 'id_establc');
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'id_staff');
    }
}
