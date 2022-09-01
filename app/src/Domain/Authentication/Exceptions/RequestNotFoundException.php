<?php

namespace Src\Domain\Authentication\Exceptions;

use Src\Domain\Shared\Exceptions\HttpException;

/**
 * Exception lifted when the given token does not exist.
 */
class RequestNotFoundException extends HttpException
{
    public function message(): string
    {
        return "Request not found";
    }

    public function code(): int
    {
        return 404;
    }
}
