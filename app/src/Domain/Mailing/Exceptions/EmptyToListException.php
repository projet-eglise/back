<?php

namespace Src\Domain\Authentication\Exceptions;

use Src\Domain\Shared\Exceptions\HttpException;

/**
 * Launched when the recipient list is empty.
 */
class EmptyToListException extends HttpException
{
    public function message(): string
    {
        return "No recipients.";
    }

    public function code(): int
    {
        return 500;
    }
}
