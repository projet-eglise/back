<?php

namespace Src\Domain\Authentication\PasswordRequest;

use Src\Domain\Authentication\User;
use Src\Domain\Shared\Timestamp;
use Src\Domain\Shared\ValueObject\StringValueObject;

class Token extends StringValueObject
{
    public static function generate(User $user): Token
    {
        return new Token(sha1(config('app.key') . $user->uuid() . time()));
    } 
}
