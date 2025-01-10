<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);
$tasks = $db->query('CALL get_task_status_counts(:creator_uuid_value, :task_for_user_uuid_value)', [
    'creator_uuid_value' => null, // pangayuon ang task na siya gabuhat
    'task_for_user_uuid_value' => $_SESSION['user']['uuid']
])->find();

view('Dashboard/user_dashboard.view.php', [
    'tasks' => $tasks
]);
