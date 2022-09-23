<?php

namespace App\Http\Resources\Authentication;

use Illuminate\Http\Resources\Json\JsonResource;

class PasswordRequest extends JsonResource
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
            'expiration' => $this->expiration,
            'is_used' => $this->is_used,
            'link' => ($this->expiration - time()) > 0 ? null : "/password-lost/{$this->token}",
        ];
    }
}
