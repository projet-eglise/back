<?php

namespace App\Http\Resources\ChurchHumanResources;

use App\Models\ChurchHumanRessources\Church;
use Illuminate\Http\Resources\Json\JsonResource;

class JoinableChurch extends JsonResource
{
    function __construct(Church $model)
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
        return [
            'name' => $this->name,
            'pastor' => [
                'firstname' => $this->pastor()->firstname,
                'lastname' => $this->pastor()->lastname,
            ],
            'joinable' => $this->joinable,
        ];
    }
}
