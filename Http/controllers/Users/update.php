<?php

use Core\App;
use Core\Database;
use Http\Forms\UpdateUserForm;

$db = App::resolve(Database::class);

$form = UpdateUserForm::validate($attributes = [
    'first_name' => $_POST['first_name'],
    'middle_name' => $_POST['middle_name'],
    'last_name' => $_POST['last_name'],
    'email' => $_POST['email']
]);

$db->query('CALL update_user(:uuid, :first_name, :middle_name, :last_name, :roles, :email)', [
    'uuid' => $_POST['uuid'],
    'first_name' => $_POST['first_name'],
    'middle_name' => $_POST['middle_name'],
    'last_name' => $_POST['last_name'],
    'roles' => $_POST['role'],
    'email' => $_POST['email']
]);

$user = $db->query('SELECT * FROM tbl_users WHERE uuid = :uuid', [
    'uuid' => $_POST['uuid']
])->findOrFail();


redirect('/user');
