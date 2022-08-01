<?php

namespace Src\Application\Authentication;

use Src\Domain\Authentication\Exceptions\InvalidCredentialsException;
use Src\Domain\Authentication\JwtToken;
use Src\Domain\Authentication\Password;
use Src\Domain\Authentication\Repositories\UserRepository;
use Src\Domain\Shared\Email;

class CheckCredentials
{
    public function __construct(private UserRepository $repository)
    {
    }

    public function __invoke(Email $email, Password $password)
    {
        $user = $this->repository->findByEmail($email);

        if ($user === null)
            throw new InvalidCredentialsException();

        if (!$user->password()->isSame($password))
            throw new InvalidCredentialsException();
    }
}
