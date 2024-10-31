<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $table = 'agenda';
    protected $primaryKey = 'id_agenda';

    protected $fillable = [
        'id_establc',
        'lun',
        'mar',
        'mie',
        'jue',
        'vie',
        'sab',
        'dom'
    ];

    public function establecimiento()
    {
        return $this->belongsTo(Establecimiento::class, 'id_establc');
    }
}
