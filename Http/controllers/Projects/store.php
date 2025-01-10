<?php

use Core\App;
use Core\Database;
use Http\Forms\ProjectForm;

$form = ProjectForm::validate($attributes = [
    'project_name' => $_POST['project_name'],
    'project_desc' => $_POST['project_desc'],
]);

$db = App::resolve(Database::class);

$db->query('CALL create_new_project(:project_name, :project_desc, :creator_uuid, :status)', [
    'project_name' => $_POST['project_name'],
    'project_desc' => $_POST['project_desc'],
    'creator_uuid' => $_POST['creator_uuid'],
    'status' => 'new',
]);

redirect('/project');
