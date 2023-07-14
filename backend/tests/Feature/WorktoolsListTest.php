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

test('Should has a route to view worktools', function () {
    $this->get(route('api.worktools.index'))->assertOk();
});

test('Should return worktools list paginated', function () {

    WorkTool::factory(5)->create([
        'user_id' => $this->user->id,
    ]);

    $expected = WorkTool::paginate(2);

    // L'url des pages dépend de l'endroit où la pagination est créée
    // On force la base des liens pour correspondre au retour de l'API
    $expected->withPath(env('APP_URL').'/api/worktools');

    $response = $this->get(route('api.worktools.index'));

    $response->assertJson([
        'success' => true,
        'message' => '',
        'data' => [
            'worktools' => $expected->toArray(),
        ],
    ]);
});

test('Should return worktools list paginated - page 2', function () {

    WorkTool::factory(5)->create([
        'user_id' => $this->user->id,
    ]);

    // On force la pagination à récupérer la page 2
    $expected = WorkTool::paginate(perPage: 2, page: 2);

    // L'url des pages dépend de l'endroit où la pagination est créée
    // On force la base des liens pour correspondre au retour de l'API
    $expected->withPath(env('APP_URL').'/api/worktools');

    $response = $this->get(route('api.worktools.index', ['page' => 2]));

    $response->assertJson([
        'success' => true,
        'message' => '',
        'data' => [
            'worktools' => $expected->toArray(),
        ],
    ]);
});
