<?php

namespace App\Http;

use App\Models\Logs\ErrorTopic;
use App\Models\Logs\Request;
use App\Models\Logs\Trace;
use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Http\Testing\File;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class,
        \Illuminate\Http\Middleware\HandleCors::class,
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        'api' => [
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array<string, class-string|string>
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticated::class,
        'auth.admin' => \App\Http\Middleware\AdminAuthenticated::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
    ];

    /**
     * Bootstrap the application for HTTP requests.
     *
     * @return void
     */
    public function bootstrap()
    {
        parent::bootstrap();
        DB::beginTransaction();
    }

    /**
     * Call the terminate method on any terminable middleware.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Http\Response  $response
     * @return void
     */
    public function terminate($request, $response)
    {
        if ($request->method() !== 'OPTIONS') {
            if (isset($request->error)) {
                $errorTopic = ErrorTopic::where('code', $request->error['code'])
                    ->where('message', $request->error['message'])
                    ->where('error', $request->error['error'])
                    ->where('file', $request->error['file'])
                    ->where('line', $request->error['line'])->first();

                if ($errorTopic === null)
                    $errorTopic = ErrorTopic::create([
                        'code' => $request->error['code'],
                        'message' => $request->error['message'],
                        'error' => $request->error['error'],
                        'file' => $request->error['file'],
                        'line' => $request->error['line'],
                    ]);
            }

            $params = $request->all();
            if (isset($params['password'])) $params['password'] = "********";
            if (isset($params['profile_picture']) && $params['profile_picture'] instanceof File) $params['profile_picture'] = "https://templates.designwizard.com/43cddf10-4af1-11e9-874a-f70add5407e2.jpg";
            $req = Request::create([
                'start' => LARAVEL_START * 10000,
                'duration' => (microtime(true) - LARAVEL_START) * 1000,
                'code' => $response->getStatusCode(),
                'message' => HttpFoundationResponse::$statusTexts[$response->getStatusCode()],
                'ip' => $request->ip(),
                'method' => $request->method(),
                'url' => $request->getRequestUri(),
                'params' => json_encode($params),
                'response' => $response->getContent() !== '' ? $response->getContent() : '[]',
                'error_topic_id' => isset($errorTopic) ? $errorTopic->id : null,
            ]);

            if (isset($request->error))
                foreach ($request->error['traces'] as $trace)
                    Trace::create([
                        'file' => $trace['file'],
                        'line' => $trace['line'],
                        'function' => $trace['function'],
                        'request_id' => $req->id,
                    ]);
        }

        DB::commit();
        parent::terminate($request, $response);
    }
}
