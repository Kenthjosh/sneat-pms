<?php

namespace Core\Middleware;

use Core\Response;

class Admin
{
    public function handle()
    {
        Middleware::resolve('auth');
        if(!$this->isAdmin($_SESSION['user'])) {
            abort(Response::FORBIDDEN);
        }
    }

    private function isAdmin($user)
    {
        // Implement your logic to check if the user is an admin
        return $user['role'] !== 'user';
    }
}
