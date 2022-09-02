<?php

namespace Src\Domain\Mailing;

abstract class From extends EmailUser
{
    abstract public function id(): int;
    abstract public function uuid(): string;

    public function value(): array
    {
        return [
            'id' => $this->id(),
            'uuid' => $this->uuid(),
            'name' => $this->name(),
            'email' => $this->email(),
        ];
    }
}
