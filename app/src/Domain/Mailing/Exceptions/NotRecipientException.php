<?php

namespace Src\Domain\Authentication\Exceptions;

use Src\Domain\Shared\Exceptions\HttpException\InternalServerErrorException;

/**
 * Invalid recipient.
 */
class NotRecipientException extends InternalServerErrorException
{
    public function message(): string
    {
        return "Not instance of Recipient";
    }
}
