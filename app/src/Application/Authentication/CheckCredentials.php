<?php

namespace Src\Application\Authentication;

use Src\Domain\Authentication\Exceptions\InvalidCredentialsException;
use Src\Domain\Authentication\Password;
use Src\Domain\Shared\Email;
use Src\Infrastructure\Authentication\Repositories\EloquentUserRepository;

class CheckCredentials
{
    public function __construct(private EloquentUserRepository $repository)
    {
    }

    public function __invoke(Email $email, Password $password)
    {
        $user = $this->repository->findByEmail($email);

        if ($user === null)
            throw new InvalidCredentialsException();

        if (!$user->passwordMatch($password))
            throw new InvalidCredentialsException();
    }
}
