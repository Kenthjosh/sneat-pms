<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$db->query('CALL restore_deleted_project(:uuid)', [
    'uuid' => $_POST['uuid']
]);

redirect('/project');