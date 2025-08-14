<?php

namespace Database\Seeders;

use App\Models\Roles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Roles::create([
            'nombre' => 'Administrador',
            'enabled' => true,
        ]);
        Roles::create([
            'nombre' => 'Operador',
            'enabled' => true,
        ]);
        Roles::create([
            'nombre' => 'Supervisor',
            'enabled' => true,
        ]);
    }
}