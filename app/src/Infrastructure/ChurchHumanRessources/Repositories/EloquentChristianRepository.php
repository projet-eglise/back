<?php

namespace Src\Infrastructure\ChurchHumanRessources\Repositories;

use Src\Domain\ChurchHumanRessources\Christian;
use App\Models\ChurchHumanRessources\Christian as ModelChristian;
use Src\Domain\ChurchHumanRessources\Christian\ProfilePicture;
use Src\Domain\ChurchHumanRessources\Exceptions\InvalidChristianException;
use Src\Domain\ChurchHumanRessources\Repositories\ChristianRepository as RepositoriesChristianRepository;
use Src\Domain\Shared\Birthdate;
use Src\Domain\Shared\Email;
use Src\Domain\Shared\Firstname;
use Src\Domain\Shared\Lastname;
use Src\Domain\Shared\PhoneNumber;
use Src\Domain\Shared\Uuid;

final class EloquentChristianRepository implements RepositoriesChristianRepository
{
    public function findByEmail(Email $email): ?Christian
    {
        $christian = ModelChristian::where('email', $email->value())->first();
        return $christian === null ? null : $this->modeltoDomain($christian);
    }

    public function create(Christian $christian)
    {
        ModelChristian::create([
            'uuid' => $christian->uuid(),
            'firstname' => $christian->firstname(),
            'lastname' => $christian->lastname(),
            'email' => $christian->email(),
            'phone' => $christian->phone(),
            'birthdate' => $christian->birthdate(),
            'profile_picture' => $christian->profilePicture(),
        ]);
    }

    public function save(Christian $christian)
    {
        $christianModel = ModelChristian::where('uuid', $christian->uuid())->first();

        if (is_null($christianModel))
            throw new InvalidChristianException();

        $christianModel->email = $christian->email();
        $christianModel->uuid = $christian->uuid();
        $christianModel->firstname = $christian->firstname();
        $christianModel->lastname = $christian->lastname();
        $christianModel->email = $christian->email();
        $christianModel->phone = $christian->phone();
        $christianModel->birthdate = $christian->birthdate();
        $christianModel->profile_picture = $christian->profilePicture();

        $christianModel->save();
    }

    public function modeltoDomain(ModelChristian $model): Christian
    {
        return new Christian(
            new Uuid($model->uuid),
            new Firstname($model->firstname),
            new Lastname($model->lastname),
            new Email($model->email),
            new PhoneNumber($model->phone),
            new Birthdate($model->birthdate),
            new ProfilePicture($model->profile_picture),
        );
    }
}
