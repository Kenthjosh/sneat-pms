<?php

use Core\App;
use Core\Database;

$title = 'Users';

$config = require base_path('config.php');;
$users = App::resolve(Database::class, $config['database'])
    ->query('SELECT * FROM active_users_view')->findAll();
$deleted_users = App::resolve(Database::class, $config['database'])
    ->query('SELECT * FROM soft_deleted_users_view')->findAll();

view('users.view.php', [
    'users' => $users,
    'deleted_users' => $deleted_users,
    'title' => $title
]);
