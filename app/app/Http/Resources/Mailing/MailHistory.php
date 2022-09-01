<?php

namespace App\Http\Resources\Mailing;

use Illuminate\Http\Resources\Json\JsonResource;

class MailHistory extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'templateAddress' => "aaa",
            'subject' => "aaa",
            'response' => [
                'code' => $this->api_response_code,
                'message' => $this->api_response_message,
            ],
            'from' => [
                'name' => "name",
                'email' => "email",
            ],
            'to' => [
                [
                    'email' => "email",
                ]
            ],
            'params' => $this->params,
            'sending_time' => $this->sending_time,
        ];
    }
}
