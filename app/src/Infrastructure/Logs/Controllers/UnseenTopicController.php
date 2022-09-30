<?php

declare(strict_types=1);

namespace Src\Infrastructure\Logs\Controllers;

use App\Models\Logs\ErrorTopic;
use Src\Infrastructure\Shared\Interfaces\Controller;
use Illuminate\Http\Request;
use Src\Domain\Logs\Exceptions\TopicNotFoundException;
use Src\Domain\Logs\Exceptions\TopicNotSeenException;

final class UnseenTopicController implements Controller
{
    public function render(Request $request)
    {
        $result = ErrorTopic::where('uuid', $request->uuid)->get();
        if ($result->isEmpty())
            throw new TopicNotFoundException();

        $topic = $result->first();

        if (!$topic->seen)
            throw new TopicNotSeenException();

        $topic->seen = false;
        $topic->save();
    }
}
