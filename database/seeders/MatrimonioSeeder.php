<?php

namespace Database\Seeders;

use App\Models\Matrimonio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MatrimonioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Matrimonio::withoutEvents(function () {
            Matrimonio::factory()->count(25000)->create([
                'id_usuario' => 1, // Fija el id_usuario a 1
            ]);
        });
    }
}
