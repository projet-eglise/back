<?php

namespace Src\Domain\ChurchHumanRessources;

abstract class Service
{
    abstract public function name(): string;
    abstract public function roles(): array;
}
