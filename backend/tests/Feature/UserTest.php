<?php

use App\Models\User;

test('Should not login - bad credentials', function () {

    $response = $this->json('post', route('api.auth.login'));

    $response->assertStatus(400);

    $response->assertJsonStructure([
        'success',
        'message',
        'data' => [],
    ]);

    $this->assertGuest();
});

test('Should login', function () {

    $user = User::factory()->create([
        'name' => 'Test User',
        'email' => 'test@test.fr',
        'password' => bcrypt('test'),
    ]);

    $response = $this->json('post', route('api.auth.login', [
        'email' => 'test@test.fr',
        'password' => 'test',
    ]));

    $response->assertStatus(200);

    $response->assertJsonStructure([
        'success',
        'message',
        'data' => [
            'user',
        ],
        'accessToken',
    ]);

    $this->assertAuthenticatedAs($user);
})->only();
