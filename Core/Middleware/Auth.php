<?php

namespace Core\Middleware;

class Auth
{
    public function handle()
    {
        // Check if the user is authenticated
        if (empty($_SESSION['user'])) {
            redirect('/login');
            exit();
        }
    }
}
