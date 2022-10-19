<?php

namespace Src\Domain\Authentication\Exceptions;

use Src\Domain\Shared\Exceptions\HttpException\GoneException;

/**
 * Exception lifted when the password request is used.
 */
class UsedPasswordRequestException extends GoneException
{
    public function message(): string
    {
        return "Password request used";
    }
}
