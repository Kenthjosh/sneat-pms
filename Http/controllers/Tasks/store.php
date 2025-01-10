<?php

use Core\App;
use Core\Database;
use Http\Forms\TaskForm;

$form = TaskForm::validate($attributes = [
    'task_name' => $_POST['task_name'],
    'task_desc' => $_POST['task_desc'],
]);


$db = App::resolve(Database::class);

$db->query('CALL create_new_task(:task_name, :task_desc, :creator_uuid, :for_user, :for_project, :status)', [
    'task_name' => $_POST['task_name'],
    'task_desc' => $_POST['task_desc'],
    'creator_uuid' => $_POST['creator_uuid'],
    'for_user' => $_POST['for_user'],
    'for_project' => $_POST['for_project'],
    'status' => 'new',
]);

redirect('/task');
