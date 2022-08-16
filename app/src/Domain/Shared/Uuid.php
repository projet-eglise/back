<?php

namespace Src\Domain\Shared;

use Illuminate\Support\Str;
use Src\Domain\Shared\ValueObject\StringValueObject;

class Uuid extends StringValueObject
{
    public function __construct(
        string $value = null
    ) {
        parent::__construct($value ?? Str::uuid()->toString());
    }
}
