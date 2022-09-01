<?php

namespace Src\Domain\Authentication\PasswordRequest;

use Src\Domain\Shared\Timestamp;

class Expiration extends Timestamp
{
    public function __construct($timestamp)
    {
        parent::__construct($timestamp);
    }

    public static function create(): Expiration
    {
        return new Expiration(Timestamp::now() + (3600 * Timestamp::coef()));
    }
}
