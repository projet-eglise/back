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
use Tests\TestCase;

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
        $all = ModelFrom::all()->toArray();
        $this->assertCount(0, $all);

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

        $all = ModelFrom::all()->toArray();
        $this->assertCount(1, $all);

        $from = new PasswordRequestFrom();

        $this->assertEquals($from->id(), $all[0]['id']);
        $this->assertEquals($from->uuid(), $all[0]['uuid']);
        $this->assertEquals($from->name(), $all[0]['name']);
        $this->assertEquals($from->email(), $all[0]['email']);
    }
}
