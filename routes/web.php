<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        dump(auth()->user()->first_name);
    }

    return response('success');
});
