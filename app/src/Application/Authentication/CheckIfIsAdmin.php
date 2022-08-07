<?php

namespace Src\Application\Authentication;

use Src\Domain\Authentication\Exceptions\InvalidCredentialsException;
use Src\Domain\Authentication\Exceptions\NotAdminException;
use Src\Domain\Shared\Email;
use Src\Infrastructure\Authentication\Repositories\EloquentUserRepository;

class CheckIfIsAdmin
{
    public function __construct(private EloquentUserRepository $repository)
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
