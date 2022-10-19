<?php

namespace Src\Domain\Authentication\Exceptions;

use Src\Domain\Shared\Exceptions\HttpException\InternalServerErrorException;

/**
 * Launched when the recipient list is empty.
 */
class EmptyToListException extends InternalServerErrorException
{
    public function message(): string
    {
        return "No recipients.";
    }
}
