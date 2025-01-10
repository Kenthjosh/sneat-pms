<?php

use Core\App;
use Core\Database;

$title = $_SESSION['user']['role'] === 'admin' ? 'All Projects' : 'My Projects';

$db = App::resolve(Database::class);

if($_SESSION['user']['role'] === 'admin') {
    $projects =  $db->query('SELECT * FROM projects_view')->findAll();
    $deleted_projects = $db->query('SELECT * FROM soft_deleted_projects_view')->findAll();
} else {
    $projects =  $db->query('SELECT * FROM projects_view WHERE creator_uuid = :creator_uuid', [
        'creator_uuid' => $_SESSION['user']['uuid']
    ])->findAll();
    $deleted_projects =  $db->query('SELECT * FROM soft_deleted_projects_view WHERE creator_uuid = :creator_uuid', [
        'creator_uuid' => $_SESSION['user']['uuid']
    ])->findAll();
}

// dd($projects);
view('projects.view.php', [
    'title' => $title,
    'projects' => $projects,
    'deleted_projects' => $deleted_projects
]);
