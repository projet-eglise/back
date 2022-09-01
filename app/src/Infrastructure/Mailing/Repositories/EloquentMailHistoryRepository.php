<?php

namespace Src\Infrastructure\Mailing\Repositories;

use Src\Domain\Mailing\MailHistory;
use Src\Domain\Mailing\Repositories\MailHistoryRepository;
use App\Models\Mailing\From as ModelFrom;
use App\Models\Mailing\MailHistory as ModelMailHistory;
use Illuminate\Support\Str;

final class EloquentMailHistoryRepository implements MailHistoryRepository
{
    public function save(MailHistory $mail)
    {
        $from = ModelFrom::where('id', $mail->fromId())->first();
        if (is_null($from))
            ModelFrom::create($mail->from());

        $mailHistory = $mail->value();
        ModelMailHistory::create([
            'uuid' => Str::uuid()->toString(),
            'template_id' => $mailHistory['template_id'],
            'from_id' => $mailHistory['from']['id'],
            'to_name' => $mailHistory['to']['name'],
            'to_email' => $mailHistory['to']['email'],
            'params' => json_encode($mailHistory['params']),
            'reply_to' => $mailHistory['reply_to'],
            'sending_time' => $mailHistory['sending_time'],
            'api_response_code' => $mailHistory['api_response_code'],
            'api_response_message' => $mailHistory['api_response_message'],
        ]);
    }
}
