<?php

namespace Src\Domain\Logs\Exceptions;

use Src\Domain\Shared\Exceptions\HttpException;

class TopicNotFoundException extends HttpException
{
    public function message(): string
    {
        return "ErrorTopic not found";
    }

    public function code(): int
    {
        return 404;
    }
}