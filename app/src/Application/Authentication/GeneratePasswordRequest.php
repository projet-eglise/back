<?php

namespace Src\Application\Authentication;

use Src\Domain\Shared\Email;
use Src\Domain\Shared\Exceptions\InvalidEmailException;
use Src\Infrastructure\Authentication\Repositories\EloquentPasswordRequestRepository;
use Src\Infrastructure\Authentication\Repositories\EloquentUserRepository;

class GeneratePasswordRequest
{
    public function __construct(
        private EloquentUserRepository $userRepository,
        private EloquentPasswordRequestRepository $passwordRequestRepository,
    ) {
    }

    public function __invoke(Email $email): string
    {
        $user = $this->userRepository->findByEmail($email);

        if ($user === null)
            throw new InvalidEmailException();

        $request = $this->passwordRequestRepository->getExistingRequest($user->uuid());
        if (is_null($request)) {
            $request = $user->generateResetPassword();
            $this->passwordRequestRepository->create($request);
        }

        return $request->token();
    }
}
