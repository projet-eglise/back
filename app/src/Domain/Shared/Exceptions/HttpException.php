<?php

namespace Src\Domain\Shared\Exceptions;

use Exception;

abstract class HttpException extends Exception
{
    /** HTTP response code */
    abstract public function code(): int;
    /** Message to display for the user */
    abstract public function message(): string;

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        return response()->json([
            'code' => $this->code(),
            'message' => $this->message()
        ], $this->code());
    }
}