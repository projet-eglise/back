<?php

namespace Src\Domain\Mailing\Repositories;

use Src\Domain\Mailing\MailHistory;

interface MailHistoryRepository
{
    public function save(MailHistory $mail);
}