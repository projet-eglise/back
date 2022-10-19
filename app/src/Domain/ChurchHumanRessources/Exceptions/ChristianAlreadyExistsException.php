<?php

namespace Src\Domain\ChurchHumanRessources\Exceptions;

use Src\Domain\Shared\Exceptions\HttpException\ConflictException;

class ChristianAlreadyExistsException extends ConflictException
{
    public function message(): string
    {
        return "Christian already exists";
    }
}
