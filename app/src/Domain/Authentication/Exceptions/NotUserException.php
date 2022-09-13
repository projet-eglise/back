<?php

namespace Src\Domain\Authentication\Exceptions;

use Src\Domain\Shared\Exceptions\HttpException;

/**
 * Exception lifted if the user did not provide the right data to authenticate.
 */
class NotUserException extends HttpException
{
    public function message(): string
    {
        return "You are not an user.";
    }

    public function code(): int
    {
        return 403;
    }
}