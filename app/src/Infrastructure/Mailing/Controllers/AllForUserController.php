<?php

declare(strict_types=1);

namespace Src\Infrastructure\Mailing\Controllers;

use App\Http\Resources\Mailing\MailHistory as MailHistoryRessource;
use App\Models\Mailing\MailHistory;
use Illuminate\Http\Request;
use Src\Infrastructure\Shared\Interfaces\Controller;

final class AllForUserController implements Controller
{
    public function render(Request $request)
    {
        return MailHistoryRessource::collection(MailHistory::select('*')->where('to', 'LIKE', "%{$request->route()->parameter('email')}%")->get());
    }
}
