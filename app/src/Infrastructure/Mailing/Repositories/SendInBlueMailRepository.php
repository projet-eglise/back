<?php

namespace Src\Infrastructure\Mailing\Repositories;

use Exception;
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
use Src\Domain\Mailing\MailHistory\ApiResponseCode;
use Src\Domain\Mailing\MailHistory\ApiResponseMessage;

final class SendInBlueMailRepository implements MailRepository
{
    public function __construct(
        private EloquentMailHistoryRepository $mailHistoryRepository,
    ) {
    }

    public function send(Mail $mail)
    {
        $apiInstance = new TransactionalEmailsApi(
            new Client(),
            Configuration::getDefaultConfiguration()->setApiKey('api-key', ENV('SENDINBLUE')),
        );

        $from = $mail->from();
        unset($from['id']);
        unset($from['uuid']);

        $sendSmtpEmail = new SendSmtpEmail();
        $sendSmtpEmail["sender"] = new SendSmtpEmailSender($from);
        $sendSmtpEmail["to"] = [new SendSmtpEmailTo($mail->to())];
        $sendSmtpEmail["templateId"] = $mail->templateId();
        $sendSmtpEmail["params"] = $mail->params();
        $sendSmtpEmail["replyTo"] = new SendSmtpEmailReplyTo(['email' => $mail->replyTo()]);
        try {
            $apiInstance->sendTransacEmail($sendSmtpEmail);
            $code = 200;
            $message = 'OK';
        } catch (Exception $e) {
            $code = $e->getCode();
            $message = $e->getMessage();
        }

        $this->mailHistoryRepository->save(
            new MailHistory(
                $mail,
                new ApiResponseCode($code),
                new ApiResponseMessage($message),
            )
        );
    }
}
