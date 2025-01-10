<?php

use Core\App;
use Core\Database;
use Http\Forms\TaskForm;

// dd($_POST);
$db = App::resolve(Database::class);

$form = TaskForm::validate($attributes = [
    'status' => $_POST['status'],
    'task_name' => $_POST['task_name'],
    'task_desc' => $_POST['task_desc'],
]);

$db->query('CALL update_task(:task_name, :task_desc, :for_project, :for_user, :uuid, :status)', [
    'task_name' => $_POST['task_name'],
    'task_desc' => $_POST['task_desc'],
    'for_project' => $_POST['for_project'],
    'for_user' => $_POST['for_user'],
    'uuid' => $_POST['uuid'],
    'status' => $_POST['status'],
]);

redirect('/task/view?id=' . $_POST['uuid']);
