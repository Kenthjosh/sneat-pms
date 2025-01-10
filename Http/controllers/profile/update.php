<?php

use Core\App;
use Core\Database;
use Core\Session;
use Http\Forms\ProfileForm;

$db = App::resolve(Database::class);

$form = ProfileForm::validate($attributes = [
    'first_name' => $_POST['first_name'],
    'middle_name' => $_POST['middle_name'],
    'last_name' => $_POST['last_name']
]);

$db->query('CALL update_profile(:uuid, :first_name, :middle_name, :last_name)', [
    'uuid' => $_POST['uuid'],
    'first_name' => $_POST['first_name'],
    'middle_name' => $_POST['middle_name'],
    'last_name' => $_POST['last_name']
]);

$user = $db->query('SELECT * FROM tbl_users WHERE uuid = :uuid', [
    'uuid' => $_POST['uuid']
])->findOrFail();

Session::updateSession($user);

redirect("/profile/view?id={$_POST['uuid']}");
