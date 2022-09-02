<?php

declare(strict_types=1);

namespace Src\Infrastructure\Authentication\Controllers;

use Illuminate\Http\Request;
use Src\Application\Authentication\CheckPasswordRequest;
use Src\Domain\Authentication\PasswordRequest\Token;
use Src\Infrastructure\Shared\Interfaces\Controller;

final class CheckPasswordRequestController implements Controller
{
    public function __construct(
        private CheckPasswordRequest $CheckPasswordRequest,
    ) {
    }

    public function render(Request $request)
    {
        $this->CheckPasswordRequest->__invoke(
            new Token($request->route()->parameter('token')),
        );

        return [];
    }
}
