<?php

namespace Src\Domain\Authentication\Exceptions;

use Src\Domain\Shared\Exceptions\HttpException\UnprocessableEntityException;

/**
 * Exception lifted if the user did not provide the right data to authenticate.
 */
class InvalidTokenException extends UnprocessableEntityException
{
    public function message(): string
    {
        return "Invalid token";
    }
}