<?php

use function Pest\Laravel\postJson;

it('can register', function () {
    $data = [
        'name' => 'Komeng1',
        'email' => 'komeng1@gmail.com',
        'username' => 'komeng1',
        'password' => 'password',
    ];
    postJson('/api/auth/register', $data)->assertStatus(201);
});

it('can not register', function () {
    $data = [
        'name' => 'Komeng1',
        'email' => 'komeng1@gmail.com',
        'username' => 'komeng1',
        'password' => 'password',
    ];
    postJson('/api/auth/register', $data)->assertStatus(400);
});

it('can login', function () {
    $data = [
        'username' => 'komeng1',
        'password' => 'password'
    ];
    postJson('/api/auth/login', $data)->assertStatus(200);
});

it('can not login', function () {
    $data = [
        'username' => 'komengs',
        'password' => 'password'
    ];
    postJson('/api/auth/login', $data)->assertStatus(400);
});
