<?php

use App\Models\Role;

test('new users can register', function () {
    $role = Role::factory()->create(['name' => 'customer']);

    $response = $this->post('/api/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'role_id' => $role->id,
    ]);

    $response->assertStatus(201);
});
