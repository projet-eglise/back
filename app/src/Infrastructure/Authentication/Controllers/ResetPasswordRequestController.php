<?php

declare(strict_types=1);

namespace Src\Infrastructure\Authentication\Controllers;

use Illuminate\Http\Request;
use Src\Application\Authentication\Events\PasswordRequestCreated;
use Src\Application\Authentication\GeneratePasswordRequest;
use Src\Domain\Shared\Email;
use Src\Infrastructure\Shared\Interfaces\Controller;

final class ResetPasswordRequestController implements Controller
{
    public function __construct(
        private GeneratePasswordRequest $GeneratePasswordRequest
    ) {
    }

    public function render(Request $request)
    {
        $token = $this->GeneratePasswordRequest->__invoke(
            new Email($request->route()->parameter('email')),
        );

        PasswordRequestCreated::dispatch(
            $request->route()->parameter('email'),
            config('app.url') . '/password-lost/' . $token
        );

        return [];
    }
}
