<?php

namespace Src\Domain\Mailing;

class Mail
{
    public function __construct(
        private TemplateId $templateId,
        private To $to,
        private Params $params,
        private From $from,
        private ReplyTo $replyTo,
    ) {
    }

    public function templateId(): int
    {
        return $this->templateId->value();
    }

    public function to(): array
    {
        return $this->to->recipients();
    }

    public function params(): array
    {
        return $this->params->value();
    }

    public function from(): array
    {
        return $this->from->value();
    }

    public function replyTo(): string
    {
        return $this->replyTo->value();
    }
}
