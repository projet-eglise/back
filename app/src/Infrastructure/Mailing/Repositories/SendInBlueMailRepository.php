<?php

namespace Src\Infrastructure\Mailing\Repositories;

use Src\Domain\Mailing\Mail;
use Src\Domain\Mailing\Repositories\MailRepository;
use GuzzleHttp\Client;
use SendinBlue\Client\Configuration;
use SendinBlue\Client\Api\TransactionalEmailsApi;
use SendinBlue\Client\Model\SendSmtpEmail;
use SendinBlue\Client\Model\SendSmtpEmailReplyTo;
use SendinBlue\Client\Model\SendSmtpEmailSender;
use SendinBlue\Client\Model\SendSmtpEmailTo;
use Src\Domain\Mailing\MailHistory;

final class SendInBlueMailRepository implements MailRepository
{
    public function __construct(
        private EloquentMailHistoryRepository $mailHistoryRepository,
    ) {
    }

    public function send(Mail $mail)
    {
        $this->mailHistoryRepository->save(
            new MailHistory($mail)
        );

        $apiInstance = new TransactionalEmailsApi(
            new Client(),
            Configuration::getDefaultConfiguration()->setApiKey('api-key', ENV('SENDINBLUE')),
        );

        $sendSmtpEmail = new SendSmtpEmail();
        $sendSmtpEmail["sender"] = new SendSmtpEmailSender($mail->from());
        $sendSmtpEmail["to"] = [new SendSmtpEmailTo($mail->to())];
        $sendSmtpEmail["templateId"] = $mail->templateId();
        $sendSmtpEmail["params"] = $mail->params();
        $sendSmtpEmail["replyTo"] = new SendSmtpEmailReplyTo(['email' => $mail->replyTo()]);
        $result = $apiInstance->sendTransacEmail($sendSmtpEmail);
    }
}
