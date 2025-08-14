<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FkUsuariosProyectos extends Model
{
    protected $table = 'fk_proyectos_usuarios';

    protected $fillable = [
        'user_id',
        'proyecto_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class);
    }
}