<?php

namespace Src\Domain\Logs\Exceptions;

use Src\Domain\Shared\Exceptions\HttpException\UnprocessableEntityException;

class TopicNotSeenException extends UnprocessableEntityException
{
    public function message(): string
    {
        return "Topic not seen";
    }
}