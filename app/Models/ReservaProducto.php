<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservaProducto extends Model
{
    protected $table = 'reserva_producto';
    public $incrementing = false;
    protected $primaryKey = ['id_cita', 'id_prod'];

    protected $fillable = [
        'id_cita',
        'id_prod',
        'cantidad'
    ];

    public function cita()
    {
        return $this->belongsTo(Cita::class, 'id_cita');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_prod');
    }
}
