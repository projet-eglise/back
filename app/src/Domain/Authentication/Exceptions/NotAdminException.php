<?php

namespace Src\Domain\Authentication\Exceptions;

use Src\Domain\Shared\Exceptions\HttpException;

/**
 * Exception lifted if the user did not provide the right data to authenticate.
 */
class NotAdminException extends HttpException
{
    public function message(): string
    {
        return "You are not an administrator.";
    }

    public function code(): int
    {
        return 403;
    }
}