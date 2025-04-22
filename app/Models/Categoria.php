<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categoria';
    protected $primaryKey = 'id_categoria';
    public $timestamps = false;

    protected $fillable = [
        'id_establc',
        'nom_categoria',
        'desc_categoria',
        'imagen'
    ];
    public function establecimiento(){
        return $this->belongsTo(Establecimiento::class, 'id_establc');
    }
}
