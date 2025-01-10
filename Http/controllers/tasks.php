<?php
use Core\App;
use Core\Database;

$title = 'Tasks';

$db = App::resolve(Database::class);
$role = $_SESSION['user']['role'];
$userUuid = $_SESSION['user']['uuid'];

// Get all tasks
if ($role !== 'user') {
    if ($role === 'project_manager') {
        // Get tasks created by the project manager
        $tasks = $db->query('SELECT * FROM tasks_view WHERE creator_uuid = :creator_uuid', [
            'creator_uuid' => $userUuid
        ])->findAll();
        $deleted_tasks = $db->query('SELECT * FROM soft_deleted_tasks_view WHERE creator_uuid = :creator_uuid', [
            'creator_uuid' => $userUuid
        ])->findAll();
    } else {
        // Get all tasks
        $tasks = $db->query('SELECT * FROM tasks_view')->findAll();
        $deleted_tasks = $db->query('SELECT * FROM soft_deleted_tasks_view')->findAll();
    }
} else {
    // Get tasks assigned to the user
    $tasks = $db->query('SELECT * FROM tasks_view WHERE task_for_user_uuid = :task_for_user_uuid', [
        'task_for_user_uuid' => $userUuid
    ])->findAll();
    $deleted_tasks = [];
}

view('tasks.view.php', [
    'title' => $title,
    'tasks' => $tasks,
    'deleted_tasks' => $deleted_tasks,
    'role' => $role
]);
