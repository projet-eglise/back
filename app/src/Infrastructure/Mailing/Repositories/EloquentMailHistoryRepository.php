<?php

namespace Src\Infrastructure\Mailing\Repositories;

use Src\Domain\Mailing\Mail;
use Src\Domain\Mailing\MailHistory;
use Src\Domain\Mailing\Repositories\MailHistoryRepository;
use App\Models\Mailing\From as ModelFrom;
use App\Models\Mailing\MailHistory as ModelMailHistory;
use Illuminate\Support\Str;

final class EloquentMailHistoryRepository implements MailHistoryRepository
{
    public function save(MailHistory $mail)
    {
        $from = ModelFrom::get($mail->fromId());
        if(is_null($from))
            ModelFrom::create($mail->from());
        
        ModelMailHistory::create([
            'uuid' => Str::uuid()->toString(),
            ...$mail->toArray(),
        ]);
    }
}
