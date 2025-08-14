<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarifas extends Model
{
    protected $table = 'tarifas';
    protected $fillable = ['nombre', 'prefijo', 'descripcion', 'enabled'];
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function tarea(){
        return $this->belongsToMany(Tarea::class, 'fk_tarifa_tarea', 'id_tarifa', 'id_tarea');
    }
}
