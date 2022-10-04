<?php

namespace Src\Domain\Shared\Exceptions;

use Src\Domain\Shared\Exceptions\HttpException;

class NotImplementedException extends HttpException
{
    public function __construct(
        protected string $error = '',
    ) {
    }

    public function code(): int
    {
        return 501;
    }

    public function message(): string
    {
        return "Not implemented";
    }
}
