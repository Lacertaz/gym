<?php

namespace Database\Seeders;

use App\RoleType;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Database\Seeders\InfoGymSeeder;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\GymPackageSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // INIT DATA ROLE START
        Role::create([
            'name' => RoleType::SUPER_ADMIN->value,
        ]);
        Role::create([
            'name' => RoleType::ADMIN->value,
        ]);
        Role::create([
            'name' => RoleType::USER->value,
        ]);
        // INIT DATA ROLE END

        // INIT DATA SUPER ADMIN START
        User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'super_admin@gym.com',
            'password' => Hash::make('password'),
        ])->assignRole(RoleType::SUPER_ADMIN->value);
        // INIT DATA SUPER ADMIN END

        // INIT DATA ADMIN START
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gym.com',
            'password' => Hash::make('password'),
        ])->assignRole(RoleType::ADMIN->value);
        // INIT DATA ADMIN START

        // INIT GYM PACKAGE & DEFAULT INFO GYM & CAROUSEL START
        $this->call([
            GymPackageSeeder::class,
            InfoGymSeeder::class,
            CarouselSeeder::class,
        ]);
        // INIT GYM PACKAGE & DEFAULT INFO GYM & CAROUSEL END
    }
}
