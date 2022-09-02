<?php

namespace Src\Domain\ChurchHumanRessources\Exceptions;

use Src\Domain\Shared\Exceptions\HttpException;

class InvalidProfileImageException extends HttpException
{
    public function message(): string
    {
        return "Invalid profile image";
    }

    public function code(): int
    {
        return 422;
    }
}