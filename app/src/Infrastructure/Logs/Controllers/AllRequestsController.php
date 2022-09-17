<?php

declare(strict_types=1);

namespace Src\Infrastructure\Logs\Controllers;

use Src\Infrastructure\Shared\Interfaces\Controller;
use App\Http\Resources\Logs\Request as RequestResource;
use App\Models\Logs\Request as RequestModel;
use Illuminate\Http\Request;

final class AllRequestsController implements Controller
{
    public function render(Request $request)
    {
        return RequestResource::collection(RequestModel::select('*')->orderByDesc('id')->get());
    }
}
