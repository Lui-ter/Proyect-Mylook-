<?php

namespace App\Models;
use App\Models\staff;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'rol';
    protected $primaryKey = 'id_rol';

    protected $fillable = [
        'nombre_rol'
    ];
    public function staff()
    {
        return $this->hasMany(staff::class, 'id_rol');
    }

}
