<?php

use Core\App;
use Core\Database;

$title = 'View Task';
$db = App::resolve(Database::class);
$task = $db->query('SELECT * FROM tasks_view WHERE uuid = :uuid', [
    'uuid' => $_GET['id']
])->find();

view('Tasks/show.view.php', [
    'title' => $title,
    'task' => $task
]);
