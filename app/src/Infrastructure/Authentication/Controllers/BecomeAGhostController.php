<?php

declare(strict_types=1);

namespace Src\Infrastructure\Authentication\Controllers;

use Illuminate\Http\Request;
use Src\Application\Authentication\CheckIfUserExists;
use Src\Application\Authentication\GenerateJwt;
use Src\Domain\Authentication\IsAdmin;
use Src\Domain\Authentication\JwtToken;
use Src\Infrastructure\Shared\Interfaces\Controller;
use Src\Domain\Shared\Email;

final class BecomeAGhostController implements Controller
{
    public function __construct(
        private CheckIfUserExists $CheckIfUserExists,
        private GenerateJwt $GenerateJwt,
    ) {
    }

    public function render(Request $request)
    {
        $this->CheckIfUserExists->__invoke(
            new Email($request->route()->parameter('email'))
        );

        return [
            'token' => $this->GenerateJwt->__invoke(new Email($request->route()->parameter('email')), new IsAdmin(false)),
        ];
    }
}
