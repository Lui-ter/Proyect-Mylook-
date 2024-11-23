<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'producto';
    protected $primaryKey = 'id_prod';

    protected $fillable = [
        'id_establc',
        'nombre_prod',
        'nom_marca',
        'desc_prod',
        'img_prod',
        'stock',
        'valor_prod'
    ];

    public function establecimiento()
    {
        return $this->belongsTo(Establecimiento::class, 'id_establc');
    }
}
