<?php

namespace Src\Domain\Authentication;

use Src\Domain\Shared\ValueObject\StringValueObject;

/**
 * Password of a user hashed as in the database. 
 * This password is used to search for a match with a non-hashed password when logging in.
 */
class HashedPassword extends StringValueObject
{
    /**
     * Checks if a non-hashed password matches this hashed password.
     *
     * @param Password $password
     * @return boolean
     */
    public function isSame(Password $password): bool{
        return password_verify($password->value(), $this->value);
    }
}
