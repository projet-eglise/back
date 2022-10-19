<?php

namespace Src\Domain\Shared\Exceptions\HttpException;

use Src\Domain\Shared\Exceptions\HttpException;

class UnauthorizedException extends HttpException
{
    public function code(): int
    {
        return 401;
    }

    public function message(): string
    {
        return "Unauthorized";
    }
}
