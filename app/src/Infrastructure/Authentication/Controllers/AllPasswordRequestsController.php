<?php

declare(strict_types=1);

namespace Src\Infrastructure\Authentication\Controllers;

use App\Http\Resources\Authentication\PasswordRequest as PasswordRequestResource;
use App\Models\Authentication\PasswordRequest;
use App\Models\Authentication\User;
use Illuminate\Http\Request;
use Src\Domain\Authentication\Exceptions\InvalidUserException;
use Src\Infrastructure\Shared\Interfaces\Controller;

final class AllPasswordRequestsController implements Controller
{
    public function render(Request $request)
    {
        $user = User::select('*')->where('email',$request->route()->parameter('email'))->first();
        if (is_null($user))
            throw new InvalidUserException();

        return PasswordRequestResource::collection(PasswordRequest::select('*')->where('user_id', $user->id)->orderByDesc('id')->get());
    }
}
