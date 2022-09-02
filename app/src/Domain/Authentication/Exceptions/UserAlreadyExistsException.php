<?php

namespace Src\Domain\Authentication\Exceptions;

use Src\Domain\Shared\Exceptions\HttpException;

class UserAlreadyExistsException extends HttpException
{
    public function message(): string
    {
        return "User already exists";
    }

    public function code(): int
    {
        return 409;
    }
}
