<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);
$users = $db->query('SELECT * FROM count_all_users_view')->find();
$tasks = $db->query('SELECT * FROM count_all_tasks_view')->find();
$projects = $db->query('SELECT * FROM count_all_projects_view')->find();

// dd($users);
view('Dashboard/admin_dashboard.view.php', [
    'users' => $users,
    'tasks' => $tasks,
    'projects' => $projects
]);
