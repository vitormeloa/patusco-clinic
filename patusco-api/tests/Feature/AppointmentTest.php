<?php

use App\Models\Appointment;
use App\Models\User;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;

uses(RefreshDatabase::class);

beforeEach(function () {
    Role::create(['name' => 'customer']);
    Role::create(['name' => 'receptionist']);
    Role::create(['name' => 'doctor']);
});

test('customer can create an appointment', function () {
    $customerRole = Role::where('name', 'customer')->first();
    $customer = User::factory()->create(['role_id' => $customerRole->id]);

    Sanctum::actingAs($customer);

    $response = $this->postJson('/api/appointments', [
        'animal_name' => 'Rex',
        'animal_type' => 'dog',
        'age' => 3,
        'symptoms' => 'Fever and vomiting',
        'appointment_date' => now()->addDays(1)->format('Y-m-d'),
        'period' => 'morning',
    ]);

    $response->assertStatus(201);
    $this->assertDatabaseHas('appointments', ['animal_name' => 'Rex']);
});

test('receptionist can view all appointments', function () {
    $receptionistRole = Role::where('name', 'receptionist')->first();
    $receptionist = User::factory()->create(['role_id' => $receptionistRole->id]);

    Appointment::factory()->count(5)->create();

    $this->actingAs($receptionist, 'sanctum');

    $response = $this->getJson('/api/appointments');

    $response->assertStatus(200);
    $response->assertJsonCount(5, 'data');
});

test('doctor can only see their own appointments', function () {
    $doctorRole = Role::where('name', 'doctor')->first();
    $doctor = User::factory()->create(['role_id' => $doctorRole->id]);

    Appointment::factory()->create(['doctor_id' => $doctor->id]);
    Appointment::factory()->create();
    $this->actingAs($doctor, 'sanctum');

    $response = $this->getJson('/api/appointments');
    $response->assertStatus(200);
    $response->assertJsonCount(1, 'data');
});
