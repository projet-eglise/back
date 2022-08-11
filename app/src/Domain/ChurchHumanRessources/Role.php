<?php

namespace Src\Domain\ChurchHumanRessources;

use Exception;
use Src\Domain\ChurchHumanRessources\Role\Name;

abstract class Role
{
    abstract public function name(): string;
    abstract public function hasOptions(): bool;

    public function isTheSameAs(Role $role): bool
    {
        // TODO Implement
        throw new Exception('Not Implemented');
    }
}
