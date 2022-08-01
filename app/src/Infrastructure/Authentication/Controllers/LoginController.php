<?php

declare(strict_types=1);

namespace Src\Infrastructure\Authentication\Controllers;

use Exception;
use Illuminate\Http\Request;
use Src\Application\Authentication\CheckCredentials;
use Src\Domain\Authentication\JwtToken;
use Src\Domain\Authentication\Password;
use Src\Domain\Authentication\User;
use Src\Infrastructure\Shared\Interfaces\Controller;
use Src\Infrastructure\Authentication\Repositories\EloquentUserRepository;
use Src\Domain\Shared\Email;

final class LoginController implements Controller
{
    public function __construct(private EloquentUserRepository $repository)
    {
    }

    public function render(Request $request)
    {
        $checkCredentials = new CheckCredentials($this->repository);
        $checkCredentials->__invoke(
            new Email($request->input('email')),
            new Password($request->input('password'), false),
        );

        return [
            'token' => JwtToken::generate([])
        ];
    }
}
