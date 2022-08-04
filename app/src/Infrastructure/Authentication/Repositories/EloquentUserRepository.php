<?php

namespace Src\Infrastructure\Authentication\Repositories;

use Src\Domain\Authentication\User;
use App\Models\Authentication\User as ModelUser;
use App\Models\Authentication\AdminUser as ModelAdminUser;
use Src\Domain\Authentication\HashedPassword;
use Src\Domain\Authentication\IsAdmin;
use Src\Domain\Authentication\Repositories\UserRepository;
use Src\Domain\Shared\Email;

final class EloquentUserRepository implements UserRepository
{
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

    public function modeltoDomain(ModelUser $model): User
    {
        return new User(
            new Email($model->email),
            new HashedPassword($model->password),
            new IsAdmin($this->isAdmin(new Email($model->email))),
        );
    }
}
