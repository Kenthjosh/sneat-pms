<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);
$tasks = $db->query('CALL get_task_status_counts(:creator_uuid_value, :task_for_user_uuid_value)', [
    'creator_uuid_value' => $_SESSION['user']['uuid'],
    'task_for_user_uuid_value' => null // pangayuon ang task nga naka assign sa iyaha
])->find();
$projects = $db->query('CALL get_project_status_counts(:uuid)', [
    'uuid' => $_SESSION['user']['uuid']
])->find();

view('Dashboard/manager_dashboard.view.php', [
    'tasks' => $tasks,
    'projects' => $projects
]);
