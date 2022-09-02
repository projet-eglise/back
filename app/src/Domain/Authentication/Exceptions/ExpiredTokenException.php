<?php

namespace Src\Domain\Authentication\Exceptions;

use Src\Domain\Shared\Exceptions\HttpException;

/**
 * Exception lifted when the token is expired.
 */
class ExpiredTokenException extends HttpException
{
    public function message(): string
    {
        return "Expirated request";
    }

    public function code(): int
    {
        return 410;
    }
}
