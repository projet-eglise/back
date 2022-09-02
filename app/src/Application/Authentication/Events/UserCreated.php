<?php

namespace Src\Application\Authentication\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Src\Application\ChurchHumanRessources\Listeners\CreateChristianCommand;

class UserCreated implements CreateChristianCommand
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(
        private string $uuid,
        private string $firstname,
        private string $lastname,
        private string $email,
        private string $phone,
        private string $birthdate,
        private string $profilePicture,
    ) {
    }

    public function uuid(): string
    {
        return $this->uuid;
    }

    public function firstname(): string
    {
        return $this->firstname;
    }

    public function lastname(): string
    {
        return $this->lastname;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function phone(): string
    {
        return $this->phone;
    }

    public function birthdate(): string
    {
        return $this->birthdate;
    }

    public function profilePicture(): string
    {
        return $this->profilePicture;
    }
}
