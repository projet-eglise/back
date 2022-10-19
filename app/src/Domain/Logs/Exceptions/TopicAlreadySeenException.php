<?php

namespace Src\Domain\Logs\Exceptions;

use Src\Domain\Shared\Exceptions\HttpException\UnprocessableEntityException;

class TopicAlreadySeenException extends UnprocessableEntityException
{
    public function message(): string
    {
        return "Topic already seen";
    }
}