<?php

namespace Src\Domain\Mailing;

use Src\Domain\Mailing\MailHistory\ApiResponseCode;
use Src\Domain\Mailing\MailHistory\ApiResponseMessage;
use Src\Domain\Shared\Timestamp;

class MailHistory
{
    public function __construct(
        private Mail $mail,
        private ApiResponseCode $code,
        private ApiResponseMessage $message,
        private Timestamp $timestamp = new Timestamp(),
    ) {
    }

    public function fromId(): int
    {
        return $this->from()['id'];
    }

    public function from(): array
    {
        return $this->mail->from();
    }

    public function value(): array
    {
        return [
            'template_id' => $this->mail->templateId(),
            'to' => $this->mail->to(),
            'params' => $this->mail->params(),
            'reply_to' => $this->mail->replyTo(),
            'sending_time' => $this->timestamp->value(),
            'from' => $this->from(),
            'api_response_code' => $this->code->value(),
            'api_response_message' => $this->message->value(),
        ];
    }
}
