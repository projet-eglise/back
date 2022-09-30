<?php

namespace Src\Domain\Logs\Exceptions;

use Src\Domain\Shared\Exceptions\HttpException;

class TopicAlreadySeenException extends HttpException
{
    public function message(): string
    {
        return "Topic already seen";
    }

    public function code(): int
    {
        return 422;
    }
}