<?php

namespace App\BrandPanel\Modules\Store\Tests\Feature\Mailing;

use App\Models\Mailing\MailHistory as ModelMailHistory;
use Src\Domain\Mailing\EmailUser;
use Src\Domain\Mailing\From\PasswordRequestFrom;
use Src\Domain\Mailing\Mail;
use Src\Domain\Mailing\Name;
use Src\Domain\Mailing\ReplyTo;
use Src\Domain\Mailing\TemplateId;
use Src\Domain\Mailing\To;
use Src\Domain\Shared\EmptyEmail;
use Src\Infrastructure\Mailing\Params\SendPasswordRequestParams;
use Src\Infrastructure\Mailing\Repositories\EloquentMailHistoryRepository;
use Src\Infrastructure\Mailing\Repositories\SendInBlueMailRepository;
use Tests\TestCase;

class ErrorTest extends TestCase
{
    private SendInBlueMailRepository $repository;

    public function __construct()
    {
        parent::__construct();
        $this->repository = new SendInBlueMailRepository(new EloquentMailHistoryRepository());
    }

    /** @test */
    public function invalid_sender()
    {
        $this->repository->send(
            new Mail(
                new TemplateId(1),
                new To([
                    new EmailUser(
                        new Name(''),
                        new EmptyEmail(),
                    ),
                ]),
                new SendPasswordRequestParams([
                    'url' => 'http://app.projet-eglise.fr',
                ]),
                new PasswordRequestFrom(),
                new ReplyTo('password-requests@projet-eglise.fr'),
            ),
        );

        $all = ModelMailHistory::all()->toArray();
        $this->assertCount(1, $all);

        $error = $all[0];
        $this->assertEquals(400, $error['api_response_code']);
        $this->assertStringContainsString('{"code":"missing_parameter","message":"email is missing in to"}', $error['api_response_message']);
    }
}
