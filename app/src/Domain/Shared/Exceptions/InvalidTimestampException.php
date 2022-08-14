<?php

namespace Src\Domain\Shared\Exceptions;

use Src\Domain\Shared\Exceptions\HttpException;

/**
 * An exception is thrown when the timestamp is not valid, e.g. has the wrong format or negative.
 */
class InvalidTimestampException extends HttpException
{
    public function __construct(
        protected string $error = '',
        private int $responseCode = 500
    ) {
    }

    public function code(): int
    {
        return $this->responseCode;
    }

    public function message(): string
    {
        return "Invalid timestamp";
    }
}
