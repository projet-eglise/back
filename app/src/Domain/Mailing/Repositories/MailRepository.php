<?php

namespace Src\Domain\Mailing\Repositories;

use Src\Domain\Mailing\Mail;
use Src\Domain\Mailing\TemplateId;

interface MailRepository
{
    public function send(Mail $mail);
    public function templateName(TemplateId $id): string;
}