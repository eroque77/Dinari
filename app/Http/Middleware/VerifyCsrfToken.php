<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
    ];

    protected function isReading($request)
    {
        return in_array($request->method(), ['HEAD', 'GET', 'OPTIONS', 'POST', 'DELETE', 'PUT']);
    }
}
