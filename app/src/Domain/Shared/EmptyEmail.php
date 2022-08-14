<?php

namespace Src\Domain\Shared;

class EmptyEmail extends Email
{
    public function __construct()
    {
        $this->value = '';
    }
}
