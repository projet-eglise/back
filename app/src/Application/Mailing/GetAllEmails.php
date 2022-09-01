<?php

namespace Src\Application\Mailing;

use App\Models\Mailing\MailHistory;

class GetAllEmails
{
    public function __invoke()
    {
        return MailHistory::select('*')
            ->orderByDesc('sending_time')
            ->get();
    }
}
