<?php

namespace Src\Application\Authentication\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Src\Application\Mailing\Mails\PasswordRequestMail;

class PasswordRequestCreated implements PasswordRequestMail 
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(
        private string $recipientEmail,
        private string $passwordRequestUrl
    ) {
    }

    public function recipientEmail(): string
    {
        return $this->recipientEmail;
    }

    public function passwordRequestUrl(): string
    {
        return $this->passwordRequestUrl;
    }

}
