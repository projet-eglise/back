<?php

namespace Src\Domain\Mailing;

use Src\Domain\Shared\Timestamp;

class MailHistory
{
    public function __construct(
        private Mail $mail,
        private Timestamp $timestamp = new Timestamp(),
    ) {
    }

    public function fromId(): array
    {
        return $this->from->id();
    }

    public function from(): array
    {
        return $this->from->toArray();
    }

    public function toArray(): array
    {
        return [
            'template_id' => $this->templateId->value(),
            'to' => $this->to->recipients(),
            'params' => $this->params->value(),
            'reply_to' => $this->replyTo->value(),
            'sending_time' => $this->timestamp->value(),
        ];
    }
}
