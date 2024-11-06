<?php

namespace Database\Seeders;

use App\Models\ActaDefuncion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActaDefuncionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ActaDefuncion::withoutEvents(function () {
            ActaDefuncion::factory()->count(25000)->create([
                'id_usuario' => 1, // Fija el id_usuario a 1
            ]);
        });

    }
}
