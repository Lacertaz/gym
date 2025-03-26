<?php

namespace Database\Seeders;

use App\Models\Carousel;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CarouselSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 9; $i++) {
            Carousel::create([
                'name' => 'Carousel ' . $i,
                'image' => 'carousel/image' . $i . '.jpg',
            ]);
        }
    }
}
