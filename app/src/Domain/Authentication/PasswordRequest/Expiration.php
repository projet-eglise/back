<?php

namespace Src\Domain\Authentication\PasswordRequest;

use Src\Domain\Shared\Timestamp;

class Expiration extends Timestamp
{
    public function __construct()
    {
        parent::__construct(Timestamp::now() + (3600 * Timestamp::coef()));
    }
}
