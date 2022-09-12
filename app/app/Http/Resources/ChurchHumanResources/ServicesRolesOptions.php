<?php

namespace App\Http\Resources\ChurchHumanResources;

use App\Models\ChurchHumanRessources\Service;
use Illuminate\Http\Resources\Json\JsonResource;

class ServicesRolesOptions extends JsonResource
{
    function __construct(Service $model)
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
        foreach ($this->roles as $role)
            $roles[] = [
                "uuid" => $role->uuid,
                "name" => $role->name,
                "options" => json_decode($role->options, true),
            ];

        return [
            "uuid" => $this->uuid,
            "name" => $this->name,
            "roles" => $roles,
        ];
    }
}
