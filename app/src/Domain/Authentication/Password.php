<?php

namespace Src\Domain\Authentication;

use Src\Domain\Authentication\Exceptions\PasswordDoesntContainRequiredCharactersException;
use Src\Domain\Shared\ValueObject\StringValueObject;

/**
 * Password in clear text.
 * You can hash this password to save it in a database. 
 */
class Password extends StringValueObject
{
    public function __construct(string $value, bool $needValidation = true)
    {
        parent::__construct($value);
        if ($needValidation)
            $this->isValid();
    }

    /**
     * Checks if the entered password matches the application's password criteria.
     */
    public function isValid()
    {
        if (!preg_match('^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$^', $this->value))
            throw new PasswordDoesntContainRequiredCharactersException();
    }

    /**
     * Return a hashed password to save in the database
     *
     * @return HashedPassword
     */
    public function hash(): HashedPassword
    {
        return new HashedPassword(password_hash($this->value, PASSWORD_BCRYPT, ['cost' => 12]));
    }
}
