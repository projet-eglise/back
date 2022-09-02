<?php

namespace Src\Domain\Authentication;

use Src\Domain\Authentication\PasswordRequest\Expiration;
use Src\Domain\Authentication\PasswordRequest\IsUsed;
use Src\Domain\Authentication\PasswordRequest\Token;
use Src\Domain\Authentication\PasswordRequest\UserUuid;
use Src\Domain\Shared\Timestamp;
use Src\Domain\Shared\Uuid;

class PasswordRequest
{
    public function __construct(
        private Uuid $uuid,
        private Token $token,
        private UserUuid $userUuid,
        private Expiration $expiration,
        private IsUsed $isUsed,
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

    public function isUsed(): bool
    {
        return $this->isUsed->value();
    }

    public function isValid(): bool
    {
        return $this->expiration->value() >= Timestamp::now();
    }

    public function used(): PasswordRequest
    {
        return new PasswordRequest(
            $this->uuid,
            $this->token,
            $this->userUuid,
            $this->expiration,
            new IsUsed(true),
        );
    }
}
