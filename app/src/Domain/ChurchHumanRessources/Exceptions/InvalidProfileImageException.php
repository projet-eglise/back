<?php

namespace Src\Domain\ChurchHumanRessources\Exceptions;

use Src\Domain\Shared\Exceptions\HttpException\UnprocessableEntityException;

class InvalidProfileImageException extends UnprocessableEntityException
{
    public function message(): string
    {
        return "Invalid profile image";
    }
}