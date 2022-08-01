<?php

namespace Src\Domain\Authentication\Exceptions;

use Src\Domain\Shared\Exceptions\HttpException;

/**
 * Exception raised if the password does not contain the right characters.
 */
class PasswordDoesntContainRequiredCharactersException extends HttpException
{
    public function message(): string
    {
        return "The password does not contain the required characters.";
    }

    public function code(): int
    {
        return 401;
    }
}