<?php

namespace Src\Domain\Shared\Exceptions\HttpException;

use Src\Domain\Shared\Exceptions\HttpException;

class ConflictException extends HttpException
{
    public function code(): int
    {
        return 409;
    }

    public function message(): string
    {
        return "Conflict";
    }
}
