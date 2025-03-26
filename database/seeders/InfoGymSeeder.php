<?php

namespace Database\Seeders;

use App\Models\InfoGym;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class InfoGymSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $base_info_gym = view('base_info_gym')->render();

        InfoGym::create([
            'description' => $base_info_gym,
        ]);
    }
}
