<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $table = 'roles';
    protected $fillable = ['nombre', 'enabled'];
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function usuarios()
    {
        return $this->hasMany(User::class, 'rol', 'id');
    }
}
