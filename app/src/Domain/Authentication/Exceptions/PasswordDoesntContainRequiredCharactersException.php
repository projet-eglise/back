<?php

namespace Src\Domain\Authentication\Exceptions;

use Src\Domain\Shared\Exceptions\HttpException\UnprocessableEntityException;

/**
 * Exception raised if the password does not contain the right characters.
 */
class PasswordDoesntContainRequiredCharactersException extends UnprocessableEntityException
{
    public function message(): string
    {
        return "The password does not contain the required characters.";
    }
}