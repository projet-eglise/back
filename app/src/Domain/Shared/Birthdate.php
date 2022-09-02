<?php

namespace Src\Domain\Shared;

use Src\Domain\Shared\Exceptions\InvalidBirthdateException;
use Src\Domain\Shared\ValueObject\StringValueObject;

class Birthdate extends StringValueObject
{
    public function __construct(string $value)
    {
        parent::__construct($value);
        $this->isValid();
    }

    public function isValid()
    {
        if(!preg_match('/^\d{4}-\d{2}-\d{2}$/', $this->value))
            throw new InvalidBirthdateException();
    }
}
