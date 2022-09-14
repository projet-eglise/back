<?php

namespace Src\Application\Authentication;

use Src\Domain\Authentication\IsAdmin;
use Src\Domain\Authentication\JwtToken;
use Src\Domain\Shared\Email;
use Src\Domain\Shared\Exceptions\InvalidEmailException;
use Src\Infrastructure\Authentication\Repositories\EloquentUserRepository;

class GenerateJwt
{
    public function __construct(
        private EloquentUserRepository $userRepository
    ) {
    }

    public function __invoke(Email $email, IsAdmin $isAdmin): string
    {
        $user = $this->userRepository->findByEmail($email);

        if ($user === null)
            throw new InvalidEmailException();

        return JwtToken::generate([
            'uuid' => $user->uuid(),
            'isAdmin' => $isAdmin->value(),
        ]);
    }
}
