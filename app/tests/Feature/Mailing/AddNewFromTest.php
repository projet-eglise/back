<?php

namespace App\BrandPanel\Modules\Store\Tests\Feature\Mailing;

use App\Models\Mailing\From as ModelFrom;
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
use Tests\Feature\Mailing\TestCase;

class AddNewFromTest extends TestCase
{
    private SendInBlueMailRepository $repository;

    public function __construct()
    {
        parent::__construct();
        $this->repository = new SendInBlueMailRepository(new EloquentMailHistoryRepository());
    }

    /** @test */
    public function from_correctly_added()
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

        $from = new PasswordRequestFrom();
        $modelFrom = ModelFrom::where('uuid', $from->uuid())->get()->first();

        $this->assertEquals($from->id(), $modelFrom['id']);
        $this->assertEquals($from->uuid(), $modelFrom['uuid']);
        $this->assertEquals($from->name(), $modelFrom['name']);
        $this->assertEquals($from->email(), $modelFrom['email']);
    }
}
