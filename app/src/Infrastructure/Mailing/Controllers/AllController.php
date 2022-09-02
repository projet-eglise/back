<?php

declare(strict_types=1);

namespace Src\Infrastructure\Mailing\Controllers;

use App\Http\Resources\Mailing\MailHistory as MailHistoryRessource;
use App\Models\Mailing\MailHistory;
use Illuminate\Http\Request;
use Src\Application\Mailing\GetAllEmails;
use Src\Infrastructure\Shared\Interfaces\Controller;

final class AllController implements Controller
{
    public function __construct(
        private GetAllEmails $GetAllEmails,
    ) {
    }

    public function render(Request $request)
    {
        return MailHistoryRessource::collection($this->GetAllEmails->__invoke());
    }
}
