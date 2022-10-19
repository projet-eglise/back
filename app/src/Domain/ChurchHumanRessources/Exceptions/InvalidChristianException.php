<?php

namespace Src\Domain\ChurchHumanRessources\Exceptions;

use Src\Domain\Shared\Exceptions\HttpException\UnprocessableEntityException;

class InvalidChristianException extends UnprocessableEntityException
{
    public function message(): string
    {
        return "Invalid christian";
    }
}