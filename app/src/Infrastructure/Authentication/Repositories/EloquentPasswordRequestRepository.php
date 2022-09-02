<?php

namespace Src\Infrastructure\Authentication\Repositories;

use App\Models\Authentication\User as ModelUser;
use App\Models\Authentication\PasswordRequest as ModelPasswordRequest;
use Src\Domain\Authentication\PasswordRequest;
use Src\Domain\Authentication\PasswordRequest\Expiration;
use Src\Domain\Authentication\PasswordRequest\IsUsed;
use Src\Domain\Authentication\PasswordRequest\Token;
use Src\Domain\Authentication\PasswordRequest\UserUuid;
use Src\Domain\Authentication\Repositories\PasswordRequestRepository;
use Src\Domain\Shared\Timestamp;
use Src\Domain\Shared\Uuid;

final class EloquentPasswordRequestRepository implements PasswordRequestRepository
{
    public function create(PasswordRequest $passwordRequest)
    {
        ModelPasswordRequest::create([
            'uuid' => $passwordRequest->uuid(),
            'token' => $passwordRequest->token(),
            'expiration' => $passwordRequest->expiration(),
            'user_id' => ModelUser::where('uuid', $passwordRequest->userUuid())->first()->id,
            'is_used' => $passwordRequest->isUsed(),
        ]);
    }

    public function save(PasswordRequest $passwordRequest)
    {
        $modelPasswordRequest = ModelPasswordRequest::where('uuid', $passwordRequest->uuid())->first();

        $modelPasswordRequest->token = $passwordRequest->token();
        $modelPasswordRequest->expiration = $passwordRequest->expiration();
        $modelPasswordRequest->user_id = ModelUser::where('uuid', $passwordRequest->userUuid())->first()->id;
        $modelPasswordRequest->is_used = $passwordRequest->isUsed();

        $modelPasswordRequest->save();
    }

    public function getExistingRequest(string $uuid): ?PasswordRequest
    {
        $request = ModelPasswordRequest::where('user_id', ModelUser::where('uuid', $uuid)->first()->id)
            ->where('expiration', '>=', Timestamp::now())
            ->where('is_used', '=', false)
            ->limit(1)
            ->first();

        return is_null($request) ? $request : $this->modeltoDomain($request);
    }

    public function getRequestByToken(string $token): ?PasswordRequest
    {
        $request = ModelPasswordRequest::where('token', $token)
            ->limit(1)
            ->first();

        return is_null($request) ? $request : $this->modeltoDomain($request);
    }

    public function modeltoDomain(ModelPasswordRequest $model): PasswordRequest
    {
        return new PasswordRequest(
            new Uuid($model->uuid),
            new Token($model->token),
            new UserUuid(ModelUser::where('id', $model->user_id)->first()->uuid),
            new Expiration($model->expiration),
            new IsUsed($model->is_used),
        );
    }
}
