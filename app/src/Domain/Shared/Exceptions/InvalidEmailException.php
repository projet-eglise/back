<?php

namespace Src\Domain\Shared\Exceptions;

use Src\Domain\Shared\Exceptions\HttpException;

/**
 * An exception is thrown when the email is not valid, e.g. has the wrong format.
 */
class InvalidEmailException extends HttpException
{
    public function __construct(
        protected string $error = '',
        private int $responseCode = 404
    ) {
    }

    public function code(): int
    {
        return $this->responseCode;
    }

    public function message(): string
    {
        return "Invalid email";
    }
}
