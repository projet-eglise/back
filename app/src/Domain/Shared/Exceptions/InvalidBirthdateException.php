<?php

namespace Src\Domain\Shared\Exceptions;

use Src\Domain\Shared\Exceptions\HttpException;

class InvalidBirthdateException extends HttpException
{
    public function __construct(
        protected string $error = '',
        private int $responseCode = 422
    ) {
    }

    public function code(): int
    {
        return $this->responseCode;
    }

    public function message(): string
    {
        return "Invalid birthdate";
    }
}
