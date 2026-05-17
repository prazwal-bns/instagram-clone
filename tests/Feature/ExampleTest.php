<?php

use App\Models\User;

it('redirects guests to login', function () {
    $this->get('/')->assertRedirect(route('login'));
});

it('returns a successful response for authenticated users', function () {
    $this->actingAs(User::factory()->create());

    $this->get('/')->assertOk();
});
