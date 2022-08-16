<?php

namespace Src\Application\Mailing\Listeners;

use Src\Application\Authentication\Events\PasswordRequestCreated;
use Src\Application\Mailing\Mails\PasswordRequestMail;
use Src\Domain\Mailing\EmailUser;
use Src\Domain\Mailing\From\PasswordRequestFrom;
use Src\Domain\Mailing\Mail;
use Src\Domain\Mailing\Name;
use Src\Domain\Mailing\ReplyTo;
use Src\Domain\Mailing\TemplateId;
use Src\Domain\Mailing\To;
use Src\Domain\Shared\Email;
use Src\Infrastructure\Mailing\Params\SendPasswordRequestParams;
use Src\Infrastructure\Mailing\Repositories\SendInBlueMailRepository;

class SendPasswordRequestNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(
        private SendInBlueMailRepository $repository,
    ) {
    }

    /**
     * Handle the event.
     *
     * @param  \Src\Application\Mailing\Mails\PasswordRequestMail  $event
     * @return void
     */
    public function handle(PasswordRequestMail $event)
    {
        $this->repository->send(new Mail(
            new TemplateId(1),
            new To([
                new EmailUser(
                    new Name('null'),
                    new Email($event->recipientEmail()),
                )
            ]),
            new SendPasswordRequestParams([
                'url' => $event->passwordRequestUrl()
            ]),
            new PasswordRequestFrom(),
            new ReplyTo('password-requests@projet-eglise.fr'),
        ));
    }
}
