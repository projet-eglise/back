<?php

namespace Src\Domain\Shared;

use Src\Domain\Shared\Exceptions\InvalidTimestampException;
use Src\Domain\Shared\ValueObject\IntegerValueObject;

class Timestamp extends IntegerValueObject
{
    public function __construct(int $value = -1)
    {
        if ($value === -1) $value = microtime(true) * Timestamp::coef();

        if ($value < -1) throw new InvalidTimestampException();
        else parent::__construct($value);
    }

    public static function now(): int
    {
        return microtime(true) * Timestamp::coef();
    }

    public static function coef(): int
    {
        return 10000;
    }
}
