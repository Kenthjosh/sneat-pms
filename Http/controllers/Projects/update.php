<?php

use Core\App;
use Core\Database;
use Http\Forms\ProjectForm;

$db = App::resolve(Database::class);

$form = ProjectForm::validate($attributes = [
    'status' => $_POST['status'],
    'project_name' => $_POST['project_name'],
    'project_desc' => $_POST['project_desc'],
]);

$db->query('CALL update_project(:project_name, :project_desc, :uuid, :status)', [
    'project_name' => $_POST['project_name'],
    'project_desc' => $_POST['project_desc'],
    'uuid' => $_POST['uuid'],
    'status' => $_POST['status'],
]);

redirect('/project/view?id=' . $_POST['uuid']);
