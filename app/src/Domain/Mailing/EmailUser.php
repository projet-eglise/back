<?php

namespace Src\Domain\Mailing;

use Src\Domain\Shared\Email;

class EmailUser
{
    public function __construct(
        private Name $name,
        private Email $email
    ) {
    }

    public function name(): string
    {
        return $this->name->value();
    }

    public function email(): string
    {
        return $this->email->value();
    }

    public function value(): array
    {
        return [
            "name" => $this->name(),
            "email" => $this->email(),
        ];
    }
}
