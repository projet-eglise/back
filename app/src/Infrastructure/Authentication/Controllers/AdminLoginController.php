<?php

declare(strict_types=1);

namespace Src\Infrastructure\Authentication\Controllers;

use Illuminate\Http\Request;
use Src\Application\Authentication\CheckCredentials;
use Src\Application\Authentication\CheckIfIsAdmin;
use Src\Domain\Authentication\JwtToken;
use Src\Domain\Authentication\Password;
use Src\Infrastructure\Shared\Interfaces\Controller;
use Src\Domain\Shared\Email;

final class AdminLoginController implements Controller
{
    public function __construct(
        private CheckCredentials $CheckCredentials,
        private CheckIfIsAdmin $CheckIfIsAdmin
    ) {
    }

    public function render(Request $request)
    {
        $this->CheckCredentials->__invoke(
            new Email($request->input('email')),
            new Password($request->input('password'), false),
        );

        $this->CheckIfIsAdmin->__invoke(
            new Email($request->input('email')),
        );

        return [
            'token' => JwtToken::generate([
                'isAdmin' => true,
            ])
        ];
    }
}
