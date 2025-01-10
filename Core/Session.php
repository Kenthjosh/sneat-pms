<?php

namespace Core;

class Session
{
    public static function has($key)
    {
        return (bool) static::get($key);
    }

    public static function put($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function get($key, $default = null)
    {
        return $_SESSION['_flash'][$key] ?? $_SESSION[$key] ?? $default;
    }

    public static function flash($key, $value)
    {
        $_SESSION['_flash'][$key] = $value;
    }

    public static function unflash()
    {
        unset($_SESSION['_flash']);
    }

    public static function forget($key)
    {
        unset($_SESSION[$key]);
    }

    public static function flush()
    {
        $_SESSION = [];
    }

    public static function destroy()
    {
        static::flush();
        session_destroy();

        $params = session_get_cookie_params();
        setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }

    public static function old($key, $default = '')
    {
        return static::get('old')[$key] ?? $default;
    }

    public static function updateSession($user)
    {
        $_SESSION['user']['uuid'] = $user['UUID'];
        $_SESSION['user']['first_name'] = $user['first_name'];
        $_SESSION['user']['middle_name'] = $user['middle_name'];
        $_SESSION['user']['last_name'] = $user['last_name'];
        $_SESSION['user']['role'] = $user['roles'];
        $_SESSION['user']['email'] = $user['email'];
        $_SESSION['user']['created_at'] = $user['created_at'];
        $_SESSION['user']['updated_at'] = $user['updated_at'];
    }
}
