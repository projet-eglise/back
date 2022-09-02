<?php

namespace Src\Domain\Shared\ValueObject;

class IntegerValueObject
{
    public function __construct(protected int $value)
    {
    }

    public function value(): int
    {
        return $this->value;
    }
}
