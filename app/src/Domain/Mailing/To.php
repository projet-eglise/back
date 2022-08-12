<?php

namespace Src\Domain\Mailing;

use Src\Domain\Authentication\Exceptions\EmptyToListException;
use Src\Domain\Authentication\Exceptions\NotRecipientException;

class To
{
    private array $recipients = [];

    public function __construct(array $recipients)
    {
        foreach ($recipients as $recipient)
            if ($recipient instanceof EmailUser)
                $this->addRecipient($recipient);
            else
                throw new NotRecipientException();
    }

    public function addRecipient(EmailUser $recipient)
    {
        $this->recipients[$recipient->email()] = $recipient;
    }

    public function removeRecipient(EmailUser $recipient): bool
    {
        if (!isset($this->recipients[$recipient->email()]))
            return false;

        unset($this->recipients[$recipient->email()]);

        return true;
    }

    public function recipients(): array
    {
        if (!isset($this->recipients) || empty($this->recipients))
            throw new EmptyToListException();

        foreach ($this->recipients as $recipient)
            $result[] = $recipient->value();

        if (count($result) === 1)
            $result = $result[0];

        if (!isset($result))
            throw new EmptyToListException();

        return $result;
    }
}
