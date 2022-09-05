<?php

namespace Src\Domain\ChurchHumanRessources;

class Member
{
    public function __construct(
        private Christian $christian,
        private Church $church,
    ) {
    }
}
