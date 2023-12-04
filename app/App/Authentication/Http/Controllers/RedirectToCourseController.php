<?php

declare(strict_types=1);

namespace App\Authentication\Http\Controllers;

use Illuminate\Routing\Controller;

class RedirectToCourseController extends Controller
{
    public function process()
    {
        dd(
            auth()->user()
        );
    }
}
