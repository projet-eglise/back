<?php

namespace Src\Application\Authentication;

use Src\Domain\Authentication\Exceptions\UserAlreadyExistsException;
use Src\Domain\Authentication\IsAdmin;
use Src\Domain\Authentication\Password;
use Src\Domain\Authentication\User;
use Src\Domain\Shared\Email;
use Src\Domain\Shared\Uuid;
use Src\Infrastructure\Authentication\Repositories\EloquentUserRepository;

class Signin
{
    public function __construct(
        private EloquentUserRepository $repository
    ) {
    }

    public function __invoke(Email $email, Password $password)
    {
        if ($this->repository->findByEmail($email) !== null)
            throw new UserAlreadyExistsException();

        $this->repository->create(new User(
            new Uuid(),
            $email,
            $password->hash(),
            new IsAdmin(false),
        ));
    }
}
