<?php

declare(strict_types=1);

namespace Src\Infrastructure\ChurchHumanRessources\Controllers;

use Illuminate\Http\Request;
use Src\Infrastructure\Shared\Interfaces\Controller;
use App\Http\Resources\ChurchHumanResources\Church as ChurchResource;
use App\Models\ChurchHumanRessources\Church;

final class AllChurchesController implements Controller
{
    public function render(Request $request)
    {
        return ChurchResource::collection(Church::all());
    }
}
