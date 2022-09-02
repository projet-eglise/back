<?php

namespace Src\Infrastructure\Authentication\Repositories;

use Src\Domain\Authentication\User;
use App\Models\Authentication\User as ModelUser;
use App\Models\Authentication\AdminUser as ModelAdminUser;
use Src\Domain\Authentication\Exceptions\InvalidUserException;
use Src\Domain\Authentication\HashedPassword;
use Src\Domain\Authentication\IsAdmin;
use Src\Domain\Authentication\PasswordRequest\UserUuid;
use Src\Domain\Authentication\Repositories\UserRepository;
use Src\Domain\Shared\Email;
use Src\Domain\Shared\Uuid;

final class EloquentUserRepository implements UserRepository
{
    public function findByUuid(UserUuid $uuid): ?User
    {
        $user = ModelUser::where('uuid', $uuid->value())->first();
        return $user === null ? null : $this->modeltoDomain($user);
    }

    public function findByEmail(Email $email): ?User
    {
        $user = ModelUser::where('email', $email->value())->first();
        return $user === null ? null : $this->modeltoDomain($user);
    }

    public function isAdmin(Email $email): bool
    {
        $user = ModelUser::where('email', $email->value())->first();
        return ModelAdminUser::where('user_id', $user->id)->first() !== null;
    }

    public function create(User $user): User
    {
        ModelUser::create([
            'uuid' => $user->uuid(),
            'email' => $user->email(),
            'password' => $user->password(),
        ]);

        return $user;
    }

    public function save(User $user)
    {
        $userModel = ModelUser::where('uuid', $user->uuid())->first();

        if (is_null($userModel))
            throw new InvalidUserException();

        $userModel->email = $user->email();
        $userModel->password = $user->password();

        // TODO Edit admin or not

        $userModel->save();
    }

    public function modeltoDomain(ModelUser $model): User
    {
        return new User(
            new Uuid($model->uuid),
            new Email($model->email),
            new HashedPassword($model->password),
            new IsAdmin($this->isAdmin(new Email($model->email))),
        );
    }
}
