<?php

use App\Models\User;
use App\Models\WorkTool;

beforeEach(function () {
    $this->user = User::factory()->create([
        'name' => 'Test User',
        'email' => 'test@test.fr',
        'password' => bcrypt('test'),
    ]);
});

test('Should has a route to view all worktools', function () {
    $this->get(route('worktools.index'))->assertOk();
});

test('Should return worktools list paginated', function () {

    WorkTool::factory(5)->create([
        'user_id' => $this->user->id,
    ]);

    $expected = WorkTool::paginate(2);

    // L'url des pages dépend de l'endroit où la pagination est créée
    // On force la base des liens pour correspondre au retour de l'API
    $expected->withPath(env('APP_URL').'/api/worktools');

    $response = $this->get(route('worktools.index'));

    $response->assertJson([
        'success' => true,
        'message' => '',
        'data' => [
            'worktools' => $expected->toArray(),
        ],
    ]);
})->only();
