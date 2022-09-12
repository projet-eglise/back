<?php

declare(strict_types=1);

namespace Src\Infrastructure\ChurchHumanRessources\Controllers;

use Illuminate\Http\Request;
use Src\Infrastructure\Shared\Interfaces\Controller;
use App\Http\Resources\ChurchHumanResources\ServicesRolesOptions;
use App\Models\ChurchHumanRessources\Role;
use App\Models\ChurchHumanRessources\Service;

final class AllServicesController implements Controller
{
    public function render(Request $request)
    {
        $services = Service::all();

        foreach ($services as $service)
            $service->roles = Role::where('service_id', $service->id)->get();

        return ServicesRolesOptions::collection($services);
    }
}
