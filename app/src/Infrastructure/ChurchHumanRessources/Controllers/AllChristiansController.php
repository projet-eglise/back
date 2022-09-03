<?php

declare(strict_types=1);

namespace Src\Infrastructure\ChurchHumanRessources\Controllers;

use App\Models\ChurchHumanRessources\Christian;
use Illuminate\Http\Request;
use Src\Infrastructure\Shared\Interfaces\Controller;
use App\Http\Resources\ChurchHumanResources\Christian as ChristianResource;

final class AllChristiansController implements Controller
{
    public function render(Request $request)
    {
        return ChristianResource::collection(Christian::all());
    }
}
