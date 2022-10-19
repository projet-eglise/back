<?php

namespace Src\Domain\Authentication\Exceptions;

use Src\Domain\Shared\Exceptions\HttpException\ConflictException;

class UserAlreadyExistsException extends ConflictException
{
    public function message(): string
    {
        return "User already exists";
    }
}
