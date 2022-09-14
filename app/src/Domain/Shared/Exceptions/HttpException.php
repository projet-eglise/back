<?php

namespace Src\Domain\Shared\Exceptions;

use Exception;

abstract class HttpException extends Exception
{
    /** HTTP response code */
    abstract public function code(): int;
    /** Information about the context of the error. */
    abstract public function message(): string;

    public function __construct(protected string $error = '')
    {}

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        $request->error['code'] = $this->code();
        $request->error['message'] = $this->message();
        $request->error['error'] = $this->error;

        return response()->json([
            'code' => $this->code(),
            'message' => $this->message(),
            'error' => $this->error,
        ], $this->code());
    }
}
