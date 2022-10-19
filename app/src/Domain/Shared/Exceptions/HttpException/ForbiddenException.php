<?php

namespace Src\Domain\Shared\Exceptions\HttpException;

use Src\Domain\Shared\Exceptions\HttpException;

class ForbiddenException extends HttpException
{
    public function code(): int
    {
        return 403;
    }

    public function message(): string
    {
        return "Forbidden";
    }
}
