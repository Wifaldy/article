<?php

function getTokenFromLogin($test)
{
    $data = [
        'username' => 'admin',
        'password' => 'password'
    ];
    $response = $test->post('/api/auth/login', $data);
    return $response->json('token');
}

function getUserId($test, $index)
{
    $token = getTokenFromLogin($test);
    $response = $test->withHeader('Authorization', 'Bearer ' . $token)->get('api/user');
    return $response->json('users')[$index]['id'];
}

it('find all users', function () {
    $token = getTokenFromLogin($this);
    $response = $this->withHeader('Authorization', 'Bearer ' . $token)->get('api/user');
    $response->assertStatus(200);
});

it('find detail user', function () {
    $token = getTokenFromLogin($this);
    $userId = getUserId($this, 0);
    $response = $this->withHeader('Authorization', 'Bearer ' . $token)->get('api/user/' . $userId);
    $response->assertStatus(200);
});

it('user not found', function () {
    $token = getTokenFromLogin($this);
    $response = $this->withHeader('Authorization', 'Bearer ' . $token)->get('api/user/0');
    $response->assertStatus(404);
});

it('create user', function () {
    $token = getTokenFromLogin($this);
    $data = [
        'role' => 'user',
        'email' => 'user@gmail.com',
        'name' => 'user',
        'username' => 'user',
        'password' => 'password',
    ];
    $response = $this->withHeader('Authorization', 'Bearer ' . $token)->post('api/user', $data);
    $response->assertStatus(201);
});

it('failed create user', function () {
    $token = getTokenFromLogin($this);
    $data = [
        'role' => 'user',
        'email' => 'user@gmailcom',
        'name' => 'user',
        'username' => 'user',
        'password' => 'password',
    ];
    $response = $this->withHeader('Authorization', 'Bearer ' . $token)->post('api/user', $data);
    $response->assertStatus(400);
});

it('update user', function () {
    $token = getTokenFromLogin($this);
    $userId = getUserId($this, 0);
    $data = [
        'role' => 'admin',
        'email' => 'user1@gmailcom',
        'name' => 'user1',
        'username' => 'user1',
        'password' => 'password',
    ];
    $response = $this->withHeader('Authorization', 'Bearer ' . $token)->put('api/user/' . $userId, $data);
    $response->assertStatus(200);
});

it('failed update user not found', function () {
    $token = getTokenFromLogin($this);
    $data = [
        'role' => 'user',
        'email' => 'user@gmailcom',
        'name' => 'user',
        'username' => 'user',
        'password' => 'password',
    ];
    $response = $this->withHeader('Authorization', 'Bearer ' . $token)->put('api/user/0', $data);
    $response->assertStatus(404);
});

it('failed update user bad request', function () {
    $token = getTokenFromLogin($this);
    $data = [
        'role' => 'user1',
        'email' => 'user@gmailcom',
        'name' => 'user',
        'username' => 'user',
        'password' => 'password',
    ];
    $response = $this->withHeader('Authorization', 'Bearer ' . $token)->put('api/user/0', $data);
    $response->assertStatus(422);
});

it('delete user', function () {
    $token = getTokenFromLogin($this);
    $userId = getUserId($this, 1);
    $response = $this->withHeader('Authorization', 'Bearer ' . $token)->delete('api/user/' . $userId);
    $response->assertStatus(200);
});

it('failed delete user', function () {
    $token = getTokenFromLogin($this);
    $response = $this->withHeader('Authorization', 'Bearer ' . $token)->delete('api/user/0');
    $response->assertStatus(404);
});
