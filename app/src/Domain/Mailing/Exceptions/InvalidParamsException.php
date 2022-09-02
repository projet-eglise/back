<?php

namespace Src\Domain\Authentication\Exceptions;

use Src\Domain\Shared\Exceptions\HttpException;

/**
 * Invalid parameters entered.
 */
class InvalidParamsException extends HttpException
{
    public function message(): string
    {
        return "Invalid params.";
    }

    public function code(): int
    {
        return 500;
    }
}
