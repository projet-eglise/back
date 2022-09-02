<?php

namespace Src\Application\Mailing\Mails;

interface PasswordRequestMail
{
    public function recipientEmail(): string;
    public function passwordRequestUrl(): string;
}