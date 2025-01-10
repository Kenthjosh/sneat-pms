<?php

namespace Core\Middleware;

class Middleware
{
    public const MAP = [
        'auth' => Auth::class,
        'guest' => Guest::class,
        'admin' => Admin::class,
    ];

    public static function resolve($key)
    {
        if (!$key) {
            return;
        }

        $middleware = static::MAP[$key] ?? false;

        if(!$middleware) {
            throw new \Exception("Middleware key '{$key}' not found");
        }

        (new $middleware)->handle();
    }
}
