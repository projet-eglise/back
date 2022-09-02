<?php

namespace Src\Domain\Authentication\Exceptions;

use Src\Domain\Shared\Exceptions\HttpException;

/**
 * Invalid recipient.
 */
class NotRecipientException extends HttpException
{
    public function message(): string
    {
        return "Not instance of Recipient";
    }

    public function code(): int
    {
        return 500;
    }
}
