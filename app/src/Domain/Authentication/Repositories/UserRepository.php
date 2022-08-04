<?php

namespace Src\Domain\Authentication\Repositories;

use Src\Domain\Authentication\User;
use Src\Domain\Shared\Email;

interface UserRepository
{
    /**
     * Search for a user by his email address.
     *
     * @param Email $email
     * @return User|null
     */
    public function findByEmail(Email $email): ?User;
    public function isAdmin(Email $email): bool;
}