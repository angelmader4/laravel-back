<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Proyecto extends Model
{
    use HasFactory;
    
    protected $table = 'proyectos';
    protected $fillable = ['nombre', 'prefijo', 'descripcion', 'enabled'];
    public $timestamps = true;
    
    protected $casts = [
        'enabled' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];


    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'fk_proyectos_usuarios', 'proyecto_id', 'user_id')->where('enabled', true);
    }

    public function tarea()
    {
        return $this->belongsToMany(Tarea::class, 'fk_proyecto_tarea', 'id_proyecto', 'id_tarea');
    }
    
}
