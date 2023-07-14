<?php

declare(strict_types=1);

use App\Models\User;
use App\Models\WorkTool;

test('Should not access Worktool creation - not logged in', function () {
    $this->json('post', route('api.worktools.store'))->assertStatus(401);
});

test('Should not create Worktool', function () {
    $user = User::factory()->create([
        'name' => 'Test User',
        'email' => 'test@test.fr',
        'password' => bcrypt('test'),
    ]);
    $token = $user->createToken('dummy');

    $response = $this->withHeaders(['Authorization' => 'Bearer '.$token->plainTextToken])->json('post', route('api.worktools.store', [
        'description' => 'test', // texte trop court
    ]));

    $response->assertStatus(422);
    $response->assertInvalid([
        'name',
        'description',
        'category',
        'ages',
        'skills',
        'type',
    ]);
    $this->assertDatabaseCount('work_tools', 0);
});

test('Should create a Worktool', function () {
    $user = User::factory()->create([
        'name' => 'Test User',
        'email' => 'test@test.fr',
        'password' => bcrypt('test'),
    ]);

    $worktool = WorkTool::factory()->make([
        'user_id' => $user->id,
    ]);

    $response = $this->actingAs($user)->json('post', route('api.worktools.store', [
        'name' => $worktool->name,
        'description' => $worktool->description,
        'category' => $worktool->category,
        'ages' => $worktool->ages,
        'skills' => $worktool->skills,
        'type' => $worktool->type,
    ]));

    $response->assertStatus(200);
    $response->assertValid();
    $this->assertDatabaseCount('work_tools', 1);
    $workToolInDb = WorkTool::first();
    expect($worktool->name)->toBe($workToolInDb->name);
    expect($worktool->description)->toBe($workToolInDb->description);
    expect($worktool->category)->toBe($workToolInDb->category);
    expect($worktool->ages)->toBe($workToolInDb->ages);
    expect($worktool->skills)->toBe($workToolInDb->skills);
    expect($worktool->type)->toBe($workToolInDb->type);
    expect($worktool->user_id)->toBe($workToolInDb->user_id);

    $response->assertJson([
        'success' => true,
        'message' => 'Worktool created',
        'data' => [
            'worktool' => $workToolInDb->toArray(),
        ],
    ]);
});
