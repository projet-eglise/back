<?php

namespace Src\Domain\Authentication\Exceptions;

use Src\Domain\Shared\Exceptions\HttpException\GoneException;

/**
 * Exception lifted when the token is expired.
 */
class ExpiredTokenException extends GoneException
{
    public function message(): string
    {
        return "Expirated request";
    }
}
