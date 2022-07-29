<?php

namespace Src\Infrastructure\Shared\Interfaces;

use Illuminate\Http\Request;

interface Controller
{
    public function render(Request $request);
}
