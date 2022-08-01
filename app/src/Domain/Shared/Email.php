<?php

namespace Src\Domain\Shared;

use Src\Domain\Shared\Exceptions\InvalidEmailException;
use Src\Domain\Shared\ValueObject\StringValueObject;

/**
 * Email address. 
 * It can be used as a login when you connect.
 */
class Email extends StringValueObject
{
    public function __construct(string $value)
    {
        parent::__construct($value);
        $this->isValid();
    }

    /**
     * Check that the email address corresponds to the criteria of an email address.
     *
     * @return boolean
     */
    public function isValid()
    {
        if (!filter_var($this->value, FILTER_VALIDATE_EMAIL))
            throw new InvalidEmailException();
    }
}
