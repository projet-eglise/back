<?php

namespace Src\Domain\Shared\ValueObject;

class BooleanValueObject
{
    public function __construct(protected bool $value)
    {
    }

    public function value(): bool
    {
        return $this->value;
    }
}
