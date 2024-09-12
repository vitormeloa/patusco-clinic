<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);

        User::factory()->create([
            'name' => 'Customer',
            'email' => 'customer@example.com',
            'role_id' => 1,
        ]);

        User::factory()->create([
            'name' => 'Receptionist',
            'email' => 'receptionist@example.com',
            'role_id' => 2,
        ]);

        User::factory()->create([
            'name' => 'Doctor',
            'email' => 'doctor@example.com',
            'role_id' => 3,
        ]);

        User::factory(10)->create(['role_id' => fake()->randomElement(Role::pluck('id')->toArray())]);

        $this->call(AppointmentSeeder::class);
    }
}
