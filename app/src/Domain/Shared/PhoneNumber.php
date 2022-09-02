<?php

namespace Src\Domain\Shared;

use Exception;
use Brick\PhoneNumber\PhoneNumber as BrickPhoneNumber;
use Brick\PhoneNumber\PhoneNumberFormat;
use Src\Domain\Shared\Exceptions\InvalidPhoneNumberException;
use Src\Domain\Shared\ValueObject\StringValueObject;

class PhoneNumber extends StringValueObject
{
    public function __construct(string $value)
    {
        parent::__construct($value);
        try {
            $number = BrickPhoneNumber::parse($value);

            if (!$number->isPossibleNumber() || !$number->isValidNumber())
                throw new Exception();
            
            $this->value = $number->format(PhoneNumberFormat::INTERNATIONAL);
        } catch (Exception $e) {
            throw new InvalidPhoneNumberException();
        }
    }
}
