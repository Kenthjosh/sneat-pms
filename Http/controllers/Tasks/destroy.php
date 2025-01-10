<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$db->query('CALL soft_delete_task(:uuid)', [
    'uuid' => $_POST['uuid']
]);

redirect('/task');
