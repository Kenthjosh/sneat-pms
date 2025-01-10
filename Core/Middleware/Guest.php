<?php

namespace Core\Middleware;

class Guest
{
    public function handle()
    {
        // Check if the user is authenticated
        if (!empty($_SESSION['user'])) {
            // If not authenticated, redirect to login page
            redirect('/');
            exit();
        }
    }
}
