<?php

declare(strict_types=1);

namespace Src\Infrastructure\ChurchHumanRessources\Controllers;

use Illuminate\Http\Request;
use Src\Infrastructure\Shared\Interfaces\Controller;
use App\Http\Resources\ChurchHumanResources\Church as ChurchResource;
use App\Http\Resources\ChurchHumanResources\JoinableChurch;
use App\Models\ChurchHumanRessources\Church;
use App\Models\ChurchHumanRessources\Member;

final class ChurchesJoinableController implements Controller
{
    public function render(Request $request)
    {
        $myChurches = [
            ...Member::where('christian_id', 2)->get(),
            ...Church::where('main_administrator_id', '<>', 2)
                ->where('pastor_id', '<>', 2)
                ->get(),
        ];

        foreach ($myChurches as $church)
            $ids[] = $church->church_id;
        
        foreach (Church::all() as $church) {
            $church->joinable = !in_array($church->id, $ids);
            $churches[] = $church;
        }

        return JoinableChurch::collection($churches);
    }
}
