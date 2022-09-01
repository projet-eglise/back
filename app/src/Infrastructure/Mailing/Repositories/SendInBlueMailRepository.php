<?php

namespace Src\Infrastructure\Mailing\Repositories;

use Exception;
use Src\Domain\Mailing\Mail;
use Src\Domain\Mailing\Repositories\MailRepository;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;
use SendinBlue\Client\Configuration;
use SendinBlue\Client\Api\TransactionalEmailsApi;
use SendinBlue\Client\Model\SendSmtpEmail;
use SendinBlue\Client\Model\SendSmtpEmailReplyTo;
use SendinBlue\Client\Model\SendSmtpEmailSender;
use SendinBlue\Client\Model\SendSmtpEmailTo;
use Src\Domain\Mailing\MailHistory;
use Src\Domain\Mailing\MailHistory\ApiResponseCode;
use Src\Domain\Mailing\MailHistory\ApiResponseMessage;
use Src\Domain\Mailing\TemplateId;

final class SendInBlueMailRepository implements MailRepository
{
    public function __construct(
        private EloquentMailHistoryRepository $mailHistoryRepository,
    ) {
    }

    private function getSendInBlueInstance(): TransactionalEmailsApi
    {
        return new TransactionalEmailsApi(
            new Client(),
            Configuration::getDefaultConfiguration()->setApiKey('api-key', ENV('SENDINBLUE')),
        );
    }

    public function send(Mail $mail)
    {
        $apiInstance = $this->getSendInBlueInstance();

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
            if ('PRD' === config('app.env') ?? '')
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

    public function templateName(TemplateId $id): string
    {
        $errorTitle = "SendInBlue error";
        $title = '';
        $instance = $this->getSendInBlueInstance();

        if (Session::has("SendInBlue.template.{$id->value()}.title"))
            return Session::get("SendInBlue.template.{$id->value()}.title");

        try {
            $title = $instance->getSmtpTemplate($id->value())->getSubject();
        } catch (Exception $e) {
            $title = $errorTitle;
        }

        Session::put("SendInBlue.template.{$id->value()}.title", $title);
        return $title;
    }
}
