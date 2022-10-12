<?php

namespace App\Http\Resources\Logs;

use App\Models\Logs\ErrorTopic;
use Illuminate\Http\Resources\Json\JsonResource;

class Request extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if($this->error_topic_id !== null)
            $errorTopicUuid = ErrorTopic::find($this->error_topic_id)->uuid;

        return [
            'code' => $this->code,
            'message' => $this->message,
            'user' => is_null($this->user_uuid) ? null : [
                'uuid' => $this->resource->userUuid(),
                'firstname' => $this->resource->userFirstname(),
                'lastname' => $this->resource->userLastname(),
                'fullname' => $this->resource->userFullname(),
                'profile_picture' => $this->resource->userProfilePicture(),
            ],
            'ip' => $this->ip,
            'start' => $this->start,
            'method' => $this->method,
            'route' => $this->url,
            'params' => $this->params,
            'response' => $this->response,
            'error_uuid' => $errorTopicUuid ?? null,
        ];
    }
}
