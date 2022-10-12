<?php

namespace App\Http\Resources\Logs;

use App\Models\Logs\ErrorTopic;
use App\Models\Logs\Request;
use App\Http\Resources\Logs\Request as RequestResource;
use App\Models\Logs\Trace;
use Illuminate\Http\Resources\Json\JsonResource;

class TopicWithRequestsAndTraces extends JsonResource
{
    function __construct(ErrorTopic $model)
    {
        parent::__construct($model);
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        foreach (Request::where('error_topic_id', $this->id)->orderByDesc('id')->get() as $requestObject)
            $requests[] = (new RequestResource($requestObject))->toArray($request);

        foreach (Trace::where('error_topic_id', $this->id)->orderByDesc('id')->get() as $trace)
            $traces[] = [
                'file' => $trace->file,
                'line' => $trace->line,
                'function' => $trace->function,
            ];
        

        return [
            'uuid' => $this->uuid,
            'code' => $this->code,
            'message' => $this->message,
            'error' => $this->error,
            'file' => $this->file,
            'line' => $this->line,
            'requests' => $requests ?? [],
            'traces' => $traces ?? [],
        ];
    }
}
