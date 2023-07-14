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
            'user' => [
                'id',
                'name',
            ],
        ],
        'accessToken',
    ]);

    $this->assertAuthenticatedAs($user);
});

test('Should logout', function () {
    $user = User::factory()->create([
        'name' => 'Test User',
        'email' => 'test@test.fr',
        'password' => bcrypt('test'),
    ]);
    $token = $user->createToken('dummy');

    $response = $this->withHeaders(['Authorization' => 'Bearer '.$token->plainTextToken])->json('get', route('api.auth.logout'));

    $response->assertStatus(200);
    $response->assertJson([
        'success' => true,
        'message' => 'Good bye',
        'data' => [],
    ]);

    $user->refresh();

    expect(count($user->tokens))->toBe(0);
});
