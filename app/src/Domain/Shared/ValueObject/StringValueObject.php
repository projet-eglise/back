<?php

namespace Src\Domain\Shared\ValueObject;

class StringValueObject
{
    public function __construct(protected string $value)
    {
    }

    public function value(): string
    {
        return $this->value;
    }
}
