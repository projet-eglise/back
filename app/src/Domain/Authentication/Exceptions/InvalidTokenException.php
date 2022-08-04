<?php

namespace Src\Domain\Authentication\Exceptions;

use Src\Domain\Shared\Exceptions\HttpException;

/**
 * Exception lifted if the user did not provide the right data to authenticate.
 */
class InvalidTokenException extends HttpException
{
    public function message(): string
    {
        return "Invalid token";
    }

    public function code(): int
    {
        return 422;
    }
}