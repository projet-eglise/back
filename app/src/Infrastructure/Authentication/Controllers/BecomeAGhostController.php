<?php

declare(strict_types=1);

namespace Src\Infrastructure\Authentication\Controllers;

use Illuminate\Http\Request;
use Src\Application\Authentication\CheckIfUserExists;
use Src\Domain\Authentication\JwtToken;
use Src\Infrastructure\Shared\Interfaces\Controller;
use Src\Domain\Shared\Email;

final class BecomeAGhostController implements Controller
{
    public function __construct(
        private CheckIfUserExists $CheckIfUserExists
    ) {
    }

    public function render(Request $request)
    {
        $this->CheckIfUserExists->__invoke(
            new Email($request->route()->parameter('email'))
        );

        return [
            'token' => JwtToken::generate([
                'isAdmin' => false,
            ])
        ];
    }
}
