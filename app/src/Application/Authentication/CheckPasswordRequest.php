<?php

namespace Src\Application\Authentication;

use Src\Domain\Authentication\Exceptions\ExpiredTokenException;
use Src\Domain\Authentication\Exceptions\RequestNotFoundException;
use Src\Domain\Authentication\Exceptions\UsedPasswordRequestException;
use Src\Domain\Authentication\PasswordRequest\Token;
use Src\Infrastructure\Authentication\Repositories\EloquentPasswordRequestRepository;

class CheckPasswordRequest
{
    public function __construct(
        private EloquentPasswordRequestRepository $repository
    ) {
    }

    public function __invoke(Token $token)
    {
        $request = $this->repository->getRequestByToken($token->value());

        if ($request === null)
            throw new RequestNotFoundException();

        if (!$request->isValid())
            throw new ExpiredTokenException();

        if ($request->isUsed())
            throw new UsedPasswordRequestException();
    }
}
