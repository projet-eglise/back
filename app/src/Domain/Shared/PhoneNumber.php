<?php

namespace Src\Domain\Shared;

use Exception;
use Src\Domain\Shared\ValueObject\StringValueObject;

class PhoneNumber extends StringValueObject
{
    public function __construct(string $value)
    {
        parent::__construct($value);
        $this->isValid();
        $this->format();
    }

    public function isValid()
    {
        // TODO Implement
        throw new Exception('Not Implemented');
    }

    public function format()
    {
        // TODO Implement
        throw new Exception('Not Implemented');
    }
}
