<?php

namespace Src\Application\Authentication;

use Src\Domain\Authentication\Exceptions\InvalidCredentialsException;
use Src\Domain\Authentication\Password;
use Src\Domain\Authentication\PasswordRequest\Token;
use Src\Domain\Authentication\PasswordRequest\UserUuid;
use Src\Domain\Shared\Email;
use Src\Infrastructure\Authentication\Repositories\EloquentPasswordRequestRepository;
use Src\Infrastructure\Authentication\Repositories\EloquentUserRepository;

class ChangePassword
{
    public function __construct(
        private EloquentPasswordRequestRepository $PasswordRequestRepository,
        private EloquentUserRepository $UserRepository,
        private CheckPasswordRequest $CheckPasswordRequest,
    ) {
    }

    public function __invoke(Token $token, Password $newPassword)
    {
        $this->CheckPasswordRequest->__invoke($token);

        $request = $this->PasswordRequestRepository->getRequestByToken($token->value());
        $user = $this->UserRepository->findByUuid(new UserUuid($request->userUuid()));

        $user = $user->changePassword($newPassword);
        $request = $request->used();
        
        $this->UserRepository->save($user);
        $this->PasswordRequestRepository->save($request);
    }
}
