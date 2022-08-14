<?php

namespace Src\Domain\Shared;

use Src\Domain\Shared\Exceptions\InvalidTimestampException;
use Src\Domain\Shared\ValueObject\IntegerValueObject;

class Timestamp extends IntegerValueObject
{
    public function __construct(int $value = -1)
    {
        if ($value === -1) $value = microtime() * 10000;

        if ($value < -1) throw new InvalidTimestampException();
        else parent::__construct($value);
    }
}
