<?php

namespace Src\Domain\Shared\Exceptions\HttpException;

use Src\Domain\Shared\Exceptions\HttpException;

class UnprocessableEntityException extends HttpException
{
    public function code(): int
    {
        return 422;
    }

    public function message(): string
    {
        return "Unprocessable entity";
    }
}
