<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FkProyectoTarea extends Model
{
    protected $table = 'fk_proyecto_tarea';

    protected $fillable = [
        'id_proyecto',
        'id_tarea'
    ];

    public function tarea()
    {
        return $this->belongsTo(Tarea::class);
    }

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class);
    }
}