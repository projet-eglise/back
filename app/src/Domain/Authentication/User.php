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
    ) {
    }

    public function password()
    {
        return $this->password;
    }
}
