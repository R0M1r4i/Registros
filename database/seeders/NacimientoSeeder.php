<?php

namespace Database\Seeders;

use App\Models\nacimiento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NacimientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        nacimiento::withoutEvents(function () {
            nacimiento::factory()->count(18000)->create([
                'id_usuario' => 1, // Fija el id_usuario a 1
            ]);
        });
    }
}
