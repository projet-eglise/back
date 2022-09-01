<?php

namespace App\Http\Resources\Mailing;

use App\Models\Mailing\From;
use Illuminate\Http\Resources\Json\JsonResource;
use Src\Domain\Mailing\TemplateId;
use Src\Infrastructure\Mailing\Repositories\EloquentMailHistoryRepository;
use Src\Infrastructure\Mailing\Repositories\SendInBlueMailRepository;

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
        $repository = new SendInBlueMailRepository(new EloquentMailHistoryRepository());
        $from = From::where('id', $this->from_id)->first();

        return [
            'templateAddress' => "https://my.sendinblue.com/camp/template/{$this->template_id}/message-setup",
            'subject' => $repository->templateName(new TemplateId($this->from_id)),
            'response' => [
                'code' => $this->api_response_code,
                'message' => $this->api_response_message,
            ],
            'from' => [
                'name' => $from->name,
                'email' => $from->email,
            ],
            'to' => json_decode($this->to, true),
            'params' => $this->params,
            'sending_time' => $this->sending_time,
        ];
    }
}
