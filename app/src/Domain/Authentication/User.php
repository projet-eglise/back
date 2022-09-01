<?php

namespace Src\Domain\Authentication;

use Src\Domain\Authentication\PasswordRequest\Expiration;
use Src\Domain\Authentication\PasswordRequest\Token;
use Src\Domain\Authentication\PasswordRequest\IsUsed;
use Src\Domain\Authentication\PasswordRequest\UserUuid;
use Src\Domain\Shared\Email;
use Src\Domain\Shared\Uuid;

/**
 * User of the application.
 * A user can log in to the app.
 */
class User
{
    public function __construct(
        private Uuid $uuid,
        private Email $email,
        private ?HashedPassword $password = null,
        private IsAdmin $isAdmin,
    ) {
    }

    public function uuid(): string
    {
        return $this->uuid->value();
    }

    public function passwordMatch(Password $password): bool
    {
        return $this->password->isSame($password);
    }

    public function isAdmin(): bool
    {
        return $this->isAdmin->value();
    }

    public function generateResetPassword(): PasswordRequest
    {
        return new PasswordRequest(
            new Uuid(),
            Token::generate($this),
            new UserUuid($this->uuid()),
            Expiration::create(),
            new IsUsed(false),
        );
    }
}
