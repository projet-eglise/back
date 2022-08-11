<?php

namespace Src\Domain\ChurchHumanRessources\Service;

use Src\Domain\ChurchHumanRessources\Role;

class Roles
{
    private array $roles = [];

    public function __construct(
        array $roles = []
    ) {
        $this->isValidForCreation($roles);
    }

    private function isValidForCreation(array $roles)
    {
        foreach ($roles as $role)
            if (!($role instanceof Role))
                throw new ThisRoleIsNotAnInstanceOfRoleException();
            else
                if(!$this->hasRole($role))
                    $this->roles[] = $role;
    }

    public function hasRole(Role $expectedRole)
    {
        foreach ($this->roles as $role)
            if ($role->isTheSameAs($expectedRole))
                return true;

        return false;
    }

    public function addRole(Role $role)
    {
        if ($this->hasRole($role))
            throw new Exception('Create Exceptuio !!');

        $this->roles[] = $role;
    }
}
