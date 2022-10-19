<?php

namespace Src\Domain\Shared\Exceptions\HttpException;

use Src\Domain\Shared\Exceptions\HttpException;

class InternalServerErrorException extends HttpException
{
    public function code(): int
    {
        return 500;
    }

    public function message(): string
    {
        return "Internal server error";
    }
}
