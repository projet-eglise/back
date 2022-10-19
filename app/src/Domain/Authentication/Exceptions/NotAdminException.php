<?php

namespace Src\Domain\Authentication\Exceptions;

use Src\Domain\Shared\Exceptions\HttpException\ForbiddenException;

/**
 * Exception lifted if the user did not provide the right data to authenticate.
 */
class NotAdminException extends ForbiddenException
{
    public function message(): string
    {
        return "You are not an administrator";
    }
}