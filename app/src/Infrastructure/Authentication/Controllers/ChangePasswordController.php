<?php

declare(strict_types=1);

namespace Src\Infrastructure\Authentication\Controllers;

use Illuminate\Http\Request;
use Src\Application\Authentication\ChangePassword;
use Src\Domain\Authentication\Password;
use Src\Domain\Authentication\PasswordRequest\Token;
use Src\Infrastructure\Shared\Interfaces\Controller;

final class ChangePasswordController implements Controller
{
    public function __construct(
        private ChangePassword $ChangePassword,
    ) {
    }

    public function render(Request $request)
    {
        $this->ChangePassword->__invoke(
            new Token($request->route()->parameter('token')),
            new Password($request->input('password'))
        );

        return [];
    }
}
