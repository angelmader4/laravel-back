<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    protected $table = 'tarea';
    protected $primaryKey = 'id';
    public $timestamps = true;
    
    protected $fillable = ['nombre', 'descripcion', 'enabled'];

    public function proyecto(){
        return $this->belongsToMany(Proyecto::class, 'fk_proyecto_tarea', 'id_tarea', 'id_proyecto');
    }
    
    public function usuario(){
        return $this->belongsToMany(User::class, 'fk_tarea_usuario', 'id_tarea', 'id_usuario');
    }

    public function tarifa(){
        return $this->belongsToMany(Tarifas::class, 'fk_tarifa_tarea', 'id_tarea', 'id_tarifa');
    }

}
