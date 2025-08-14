<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FkTareaUsuario extends Model
{
    protected $table = 'fk_tarea_usuario';

    protected $fillable = [
        'id_tarea',
        'id_usuario'
    ];

    public function tarea()
    {
        return $this->belongsTo(Tarea::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }
}