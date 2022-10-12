<?php

declare(strict_types=1);

namespace Src\Infrastructure\Logs\Controllers;

use App\Http\Resources\Logs\TopicWithRequestsAndTraces;
use App\Models\Logs\ErrorTopic;
use Illuminate\Http\Request;
use Src\Domain\Logs\Exceptions\TopicNotFoundException;
use Src\Infrastructure\Shared\Interfaces\Controller;

final class TopicWithRequestsAndTracesController implements Controller
{
    public function render(Request $request)
    {
        $result = ErrorTopic::where('uuid', $request->uuid)->get();
        if ($result->isEmpty())
            throw new TopicNotFoundException();

        return new TopicWithRequestsAndTraces($result->first());
    }
}
