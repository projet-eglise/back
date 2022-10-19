<?php

namespace Src\Domain\Logs\Exceptions;

use Src\Domain\Shared\Exceptions\HttpException\NotFoundException;

class TopicNotFoundException extends NotFoundException
{
    public function message(): string
    {
        return "ErrorTopic not found";
    }
}