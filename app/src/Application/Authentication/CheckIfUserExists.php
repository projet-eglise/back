<?php

namespace Src\Application\Authentication;

use Src\Domain\Authentication\Exceptions\InvalidUserException;
use Src\Domain\Shared\Email;
use Src\Infrastructure\Authentication\Repositories\EloquentUserRepository;

class CheckIfUserExists
{
    public function __construct(
        private EloquentUserRepository $UserRepository,
    ) {
    }

    public function __invoke(Email $email)
    {
        if (is_null($this->UserRepository->findByEmail($email)))
            throw new InvalidUserException();
    }
}
