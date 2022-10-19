<?php

namespace Src\Domain\Authentication\Exceptions;

use Src\Domain\Shared\Exceptions\HttpException\NotFoundException;

/**
 * Exception lifted when the given token does not exist.
 */
class RequestNotFoundException extends NotFoundException
{
    public function message(): string
    {
        return "Request not found";
    }
}
