<?php

namespace Database\Seeders;

use App\MemberType;
use App\Models\GymPackage;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GymPackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GymPackage::create([
            'name' => 'Paket Penghuni 1 Bulan',
            'price' => 50_000,
            'duration' => 1,
            'member_type' => MemberType::PENGHUNI,
        ]);

        GymPackage::create([
            'name' => 'Paket Penghuni 3 Bulan',
            'price' => 150_000,
            'duration' => 3,
            'member_type' => MemberType::PENGHUNI,
        ]);

        GymPackage::create([
            'name' => 'Paket Penghuni 6 Bulan',
            'price' => 300_000,
            'duration' => 6,
            'member_type' => MemberType::PENGHUNI,
        ]);

        GymPackage::create([
            'name' => 'Paket Non Penghuni 1 Bulan',
            'price' => 100_000,
            'duration' => 1,
            'member_type' => MemberType::NON_PENGHUNI,
        ]);

        GymPackage::create([
            'name' => 'Paket Non Penghuni 3 Bulan',
            'price' => 300_000,
            'duration' => 3,
            'member_type' => MemberType::NON_PENGHUNI,
        ]);

        GymPackage::create([
            'name' => 'Paket Non Penghuni 6 Bulan',
            'price' => 600_000,
            'duration' => 6,
            'member_type' => MemberType::NON_PENGHUNI,
        ]);
    }
}
