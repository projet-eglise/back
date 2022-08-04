<?php

namespace Src\Domain\Authentication;

use Src\Domain\Shared\Email;

/**
 * User of the application.
 * A user can log in to the app.
 */
class User
{
    public function __construct(
        private Email $email,
        private ?HashedPassword $password = null,
        private IsAdmin $isAdmin,
    ) {
    }

    public function passwordMatch(Password $password): bool
    {
        return $this->password->isSame($password);
    }

    public function isAdmin(): bool
    {
        return $this->isAdmin->value();
    }
}
