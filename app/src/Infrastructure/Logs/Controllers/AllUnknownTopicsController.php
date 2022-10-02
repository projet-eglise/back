<?php

declare(strict_types=1);

namespace Src\Infrastructure\Logs\Controllers;

use App\Http\Resources\Logs\ErrorTopicWithOccurrences;
use App\Models\Logs\ErrorTopic;
use Src\Infrastructure\Shared\Interfaces\Controller;
use Illuminate\Http\Request;

final class AllUnknownTopicsController implements Controller
{
    public function render(Request $request)
    {
        return ErrorTopicWithOccurrences::collection(ErrorTopic::where('known', false)->get());
    }
}
