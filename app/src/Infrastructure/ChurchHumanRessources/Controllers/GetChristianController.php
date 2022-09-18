<?php

declare(strict_types=1);

namespace Src\Infrastructure\ChurchHumanRessources\Controllers;

use App\Http\Resources\ChurchHumanResources\Christian as ChristianResource;
use Illuminate\Http\Request;
use Src\Infrastructure\Shared\Interfaces\Controller;
use App\Models\ChurchHumanRessources\Christian;
use Src\Domain\ChurchHumanRessources\Exceptions\InvalidChristianException;

final class GetChristianController implements Controller
{
    public function render(Request $request)
    {
        $result = Christian::where('uuid', $request->route()->parameter('uuid'))->get();

        if ($result->count() !== 1)
            throw new InvalidChristianException();

        $christian = $result->first();

        return new ChristianResource($christian);
    }
}
