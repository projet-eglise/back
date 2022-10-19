<?php

namespace Src\Domain\Shared\Exceptions\HttpException;

use Src\Domain\Shared\Exceptions\HttpException;

class GoneException extends HttpException
{
    public function code(): int
    {
        return 410;
    }

    public function message(): string
    {
        return "Gone";
    }
}
