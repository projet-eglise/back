<?php

namespace Src\Domain\Authentication\Repositories;

use Src\Domain\Authentication\PasswordRequest;

interface PasswordRequestRepository
{
    public function save(PasswordRequest $passwordRequest);
    public function getExistingRequest(string $uuid): ?PasswordRequest;
    public function getRequestByToken(string $token): ?PasswordRequest;
}