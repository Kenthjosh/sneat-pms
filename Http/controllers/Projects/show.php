<?php

use Core\App;
use Core\Database;

$title = 'View Project';
$db = App::resolve(Database::class);
$project = $db->query('SELECT * FROM projects_view WHERE uuid = :uuid', [
    'uuid' => $_GET['id']
])->find();

view('Projects/show.view.php', [
    'title' => $title,
    'project' => $project
]);
