<?php

namespace Src\Domain\Shared\Exceptions\HttpException;

use Src\Domain\Shared\Exceptions\HttpException;

class NotFoundException extends HttpException
{
    public function code(): int
    {
        return 404;
    }

    public function message(): string
    {
        return "Not found";
    }
}
