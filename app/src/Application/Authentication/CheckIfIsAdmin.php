<?php

namespace Src\Application\Authentication;

use Src\Domain\Authentication\Exceptions\InvalidCredentialsException;
use Src\Domain\Authentication\Exceptions\NotAdminException;
use Src\Domain\Authentication\JwtToken;
use Src\Domain\Authentication\Password;
use Src\Domain\Authentication\Repositories\UserRepository;
use Src\Domain\Shared\Email;

class CheckIfIsAdmin
{
    public function __construct(private UserRepository $repository)
    {
    }

    public function __invoke(Email $email)
    {
        $user = $this->repository->findByEmail($email);

        if ($user === null)
            throw new InvalidCredentialsException();

        if (!$user->isAdmin())
            throw new NotAdminException();
    }
}
