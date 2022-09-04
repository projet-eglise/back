<?php

namespace App\Http\Resources\ChurchHumanResources;

use Illuminate\Http\Resources\Json\JsonResource;

class Church extends JsonResource
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
            'name' => $this->name,
            'pastor' => [
                'firstname' => $this->pastor()->firstname,
                'lastname' => $this->pastor()->lastname,
            ],
            'main_administrator' => [
                'firstname' => $this->main_administrator()->firstname,
                'lastname' => $this->main_administrator()->lastname,
            ],
            'address' => $this->address,
            'postal_code' => $this->postal_code,
            'city' => $this->city,
        ];
    }
}
