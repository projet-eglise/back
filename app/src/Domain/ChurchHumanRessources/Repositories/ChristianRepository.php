<?php

namespace Src\Domain\ChurchHumanRessources\Repositories;

use Src\Domain\ChurchHumanRessources\Christian;
use Src\Domain\Shared\Email;

interface ChristianRepository
{
    public function findByEmail(Email $email): ?Christian;

    public function create(Christian $christian);
    public function save(Christian $christian);
}