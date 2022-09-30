<?php

namespace Src\Domain\Logs\Exceptions;

use Src\Domain\Shared\Exceptions\HttpException;

class TopicNotSeenException extends HttpException
{
    public function message(): string
    {
        return "Topic not seen";
    }

    public function code(): int
    {
        return 422;
    }
}