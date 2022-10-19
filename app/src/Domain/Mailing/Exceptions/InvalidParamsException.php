<?php

namespace Src\Domain\Authentication\Exceptions;

use Src\Domain\Shared\Exceptions\HttpException\InternalServerErrorException;

/**
 * Invalid parameters entered.
 */
class InvalidParamsException extends InternalServerErrorException
{
    public function message(): string
    {
        return "Invalid params";
    }
}
