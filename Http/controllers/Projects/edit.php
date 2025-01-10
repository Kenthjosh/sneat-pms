<?php

use Core\App;
use Core\Database;
use Core\Session;

$title = 'Edit Project';
$db = App::resolve(Database::class);
$project = $db->query('SELECT * FROM projects_view WHERE uuid = :uuid', [
    'uuid' => $_GET['id']
])->find();

authorize($_SESSION['user']['uuid'] === $project['creator_uuid'] || $_SESSION['user']['role'] === 'admin');

view('Projects/edit.view.php', [
    'title' => $title,
    'project' => $project,
    'errors' => Session::get('errors')
]);
