<?php

namespace Src\Domain\Authentication\Exceptions;

use Src\Domain\Shared\Exceptions\HttpException;

/**
 * Exception lifted when the password request is used.
 */
class UsedPasswordRequestException extends HttpException
{
    public function message(): string
    {
        return "Password request used";
    }

    public function code(): int
    {
        return 410;
    }
}
