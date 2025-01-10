<?php

use Core\App;
use Core\Database;
use Core\Session;

$title = 'Add new Task';

$db = App::resolve(Database::class);
$users = $db->query('SELECT * FROM active_users_view')->findAll();
if($_SESSION['user']['role'] === 'admin') {
    $projects = $db->query('SELECT * FROM projects_view')->findAll();
} else {
    $projects =  $db->query('SELECT * FROM projects_view WHERE creator_uuid = :creator_uuid', [
        'creator_uuid' => $_SESSION['user']['uuid']
    ])->findAll();
}

view('Tasks/create.view.php', [
    'title' => $title,
    'users' => $users,
    'projects' => $projects,
    'errors' => Session::get('errors')
]);
