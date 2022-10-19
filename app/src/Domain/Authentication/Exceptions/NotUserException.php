<?php

namespace Src\Domain\Authentication\Exceptions;

use Src\Domain\Shared\Exceptions\HttpException\ForbiddenException;

/**
 * Exception lifted if the user did not provide the right data to authenticate.
 */
class NotUserException extends ForbiddenException
{
    public function message(): string
    {
        return "You are not an user";
    }
}