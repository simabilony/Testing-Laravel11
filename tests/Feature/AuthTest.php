<?php

use App\Models\User;
use function Pest\Laravel\get;
use function Pest\Laravel\post;

test('example', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

test('unauthenticated user cannot access product', function () {
    get('/products')
        ->assertStatus(302)
        ->assertRedirect('login');
});
// ...

test('login redirects to products', function () {
    User::create([
        'name' => 'User',
        'email' => 'user@user.com',
        'password' => bcrypt('password123')
    ]);

    post('/login', [
        'email' => 'user@user.com',
        'password' => 'password123'
    ])
        ->assertStatus(302)
        ->assertRedirect('products');
});
