<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServEstablecimiento extends Model
{
    protected $table = 'serv_establecimiento';
    public $incrementing = false;
    protected $primaryKey = ['id_servicio', 'id_establc'];

    protected $fillable = [
        'id_servicio',
        'id_establc'
    ];

    public function servicio()
    {
        return $this->belongsTo(Servicio::class, 'id_servicio');
    }

    public function establecimiento()
    {
        return $this->belongsTo(Establecimiento::class, 'id_establc');
    }
}
