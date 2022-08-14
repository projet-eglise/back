<?php

namespace Src\Domain\Mailing;

use Src\Domain\Shared\Email;

class PasswordRequestFrom extends From
{
    public function __construct()
    {
        parent::__construct(
            new Name("Projet d'Eglise"),
            new Email('password-requests@projet-eglise.fr'),
        );
    }

    public function id(): int
    {
        return 1;
    }

    public function uuid(): string
    {
        return 'fa464b4f-6f58-4c5c-bbd3-7611959c2bab';
    }
}
