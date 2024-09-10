<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentFactory extends Factory
{
    protected $model = Appointment::class;

    public function definition(): array
    {
        return [
            'customer_id' => User::factory()->state(['role_id' => Role::where('name', 'customer')->first()->id]),
            'doctor_id' => User::factory()->state(['role_id' => Role::where('name', 'doctor')->first()->id]),
            'animal_name' => $this->faker->firstName,
            'animal_type' => $this->faker->randomElement(['dog', 'cat', 'bird']),
            'age' => $this->faker->numberBetween(1, 15),
            'symptoms' => $this->faker->sentence,
            'appointment_date' => $this->faker->dateTimeBetween('now', '+1 month'),
            'period' => $this->faker->randomElement(['morning', 'afternoon']),
            'status' => $this->faker->randomElement(['pending', 'completed', 'cancelled']),
        ];
    }
}
