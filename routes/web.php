<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response('ok');
});

Route::get('login', function () {
    return redirect()->route('saml.login', [
        'uuid' => 'a5c5d904-ed29-4462-ab6b-e73cb3270967',
    ]);
})
    ->name('login');
