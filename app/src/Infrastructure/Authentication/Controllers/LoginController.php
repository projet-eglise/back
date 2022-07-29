<?php

declare(strict_types=1);

namespace Src\Infrastructure\Authentication\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Src\Infrastructure\Shared\Interfaces\Controller;

final class LoginController implements Controller
{
    public function render(Request $request)
    {
        return [];
    }
}
