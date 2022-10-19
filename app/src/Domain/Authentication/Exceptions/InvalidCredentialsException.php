<?php

namespace Src\Domain\Authentication\Exceptions;

use Src\Domain\Shared\Exceptions\HttpException\UnauthorizedException;

/**
 * Exception lifted if the user did not provide the right data to authenticate.
 */
class InvalidCredentialsException extends UnauthorizedException
{
    public function message(): string
    {
        return "Invalid credentials";
    }
}
