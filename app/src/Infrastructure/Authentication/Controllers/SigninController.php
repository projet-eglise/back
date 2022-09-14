<?php

declare(strict_types=1);

namespace Src\Infrastructure\Authentication\Controllers;

use Illuminate\Http\Request;
use Src\Application\Authentication\Events\HasProfilePicture;
use Src\Application\Authentication\Events\UserCreated;
use Src\Application\Authentication\GenerateJwt;
use Src\Application\Authentication\Signin;
use Src\Domain\Authentication\IsAdmin;
use Src\Domain\Authentication\Password;
use Src\Infrastructure\Shared\Interfaces\Controller;
use Src\Domain\Shared\Email;

final class SigninController implements Controller
{
    public function __construct(
        private Signin $Signin,
        private GenerateJwt $GenerateJwt,
    ) {
    }

    public function render(Request $request)
    {
        $user = $this->Signin->__invoke(
            new Email($request->input('email')),
            new Password($request->input('password')),
        );

        UserCreated::dispatch(
            $user->uuid(),
            $request->input('firstname'),
            $request->input('lastname'),
            $request->input('email'),
            $request->input('phone'),
            $request->input('birthdate'),
            $request->hasFile('profile_picture') ?
                HasProfilePicture::dispatch(
                    $request->file('profile_picture')
                )[0] : '',
        );

        return [
            'token' => $this->GenerateJwt->__invoke(new Email($request->input('email')), new IsAdmin(false)),
        ];
    }
}
