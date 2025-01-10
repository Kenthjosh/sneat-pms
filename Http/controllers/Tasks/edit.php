<?php

use Core\App;
use Core\Database;
use Core\Session;

$title = 'Edit Project';
$db = App::resolve(Database::class);
$task = $db->query('SELECT * FROM tasks_view WHERE uuid = :uuid', [
    'uuid' => $_GET['id']
])->find();
$projects = $db->query('SELECT * FROM projects_view')->findAll();
$users = $db->query('SELECT * FROM active_users_view')->findAll();

authorize($_SESSION['user']['uuid'] === $task['creator_uuid'] || $_SESSION['user']['role'] === 'admin');

view('Tasks/edit.view.php', [
    'title' => $title,
    'task' => $task,
    'projects' => $projects,
    'users' => $users,
    'errors' => Session::get('errors')
]);
