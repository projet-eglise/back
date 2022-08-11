<?php

namespace Src\Domain\Shared;

use Exception;
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
        // TODO Implement
        throw new Exception('Not Implemented');
    }
}
