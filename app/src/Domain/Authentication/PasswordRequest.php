<?php

namespace Src\Domain\Authentication;

use Src\Domain\Authentication\PasswordRequest\Expiration;
use Src\Domain\Authentication\PasswordRequest\Token;
use Src\Domain\Authentication\PasswordRequest\UserUuid;
use Src\Domain\Shared\Uuid;

class PasswordRequest
{
    public function __construct(
        private Uuid $uuid,
        private Token $token,
        private UserUuid $userUuid,
        private Expiration $expiration,
    ) {
    }

    public function uuid(): string
    {
        return $this->uuid->value();
    }

    public function token(): string
    {
        return $this->token->value();
    }

    public function userUuid(): string
    {
        return $this->userUuid->value();
    }

    public function expiration(): int
    {
        return $this->expiration->value();
    }
}
