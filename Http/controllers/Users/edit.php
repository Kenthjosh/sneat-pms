<?php

$title = 'Edit user';

use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);

$user = $db->query('SELECT * FROM tbl_users WHERE UUID = :UUID', [
    'UUID' => $_GET['id']
])->findOrFail();

view('Users/edit.view.php',  [
    'errors' => Session::get('errors'),
    'title' => $title,
    'user' => $user
]);
