<?php

declare(strict_types=1);

namespace Src\Infrastructure\Authentication\Controllers;

use Exception;
use Illuminate\Http\Request;
use Src\Application\Authentication\CheckCredentials;
use Src\Application\Authentication\Signin;
use Src\Domain\Authentication\JwtToken;
use Src\Domain\Authentication\Password;
use Src\Domain\Authentication\User;
use Src\Infrastructure\Shared\Interfaces\Controller;
use Src\Infrastructure\Authentication\Repositories\EloquentUserRepository;
use Src\Domain\Shared\Email;

final class SigninController implements Controller
{
    public function __construct(
        private Signin $Signin,
    ) {
    }

    public function render(Request $request)
    {
        $this->Signin->__invoke(
            new Email($request->input('email')),
            new Password($request->input('password')),
        );

        return [
            'token' => JwtToken::generate([
                'isAdmin' => false,
            ])
        ];
    }
}
