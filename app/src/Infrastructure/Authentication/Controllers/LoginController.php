<?php

declare(strict_types=1);

namespace Src\Infrastructure\Authentication\Controllers;

use Illuminate\Http\Request;
use Src\Application\Authentication\CheckCredentials;
use Src\Application\Authentication\GenerateJwt;
use Src\Domain\Authentication\IsAdmin;
use Src\Domain\Authentication\Password;
use Src\Infrastructure\Shared\Interfaces\Controller;
use Src\Domain\Shared\Email;

final class LoginController implements Controller
{
    public function __construct(
        private CheckCredentials $CheckCredentials,
        private GenerateJwt $GenerateJwt,
    ) {
    }

    public function render(Request $request)
    {
        $this->CheckCredentials->__invoke(
            new Email($request->input('email')),
            new Password($request->input('password'), false),
        );

        return [
            'token' => $this->GenerateJwt->__invoke(new Email($request->input('email')), new IsAdmin(false)),
        ];
    }
}
