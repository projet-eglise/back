<?php

namespace Src\Domain\Mailing\Repositories;

use Src\Domain\Mailing\Mail;

interface MailRepository
{
    public function send(Mail $mail);
}