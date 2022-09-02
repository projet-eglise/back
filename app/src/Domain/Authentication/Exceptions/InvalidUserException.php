<?php

namespace Src\Domain\Authentication\Exceptions;

use Src\Domain\Shared\Exceptions\HttpException;

/**
 * Exception lifted if the user did not provide the right data to authenticate.
 */
class InvalidUserException extends HttpException
{
    public function message(): string
    {
        return "Invalid user";
    }

    public function code(): int
    {
        return 422;
    }
}