<?php

use Core\App;
use Core\Database;

$title = 'View User';
$db = App::resolve(Database::class);
$user = $db->query('SELECT * FROM active_users_view WHERE uuid = :uuid', [
    'uuid' => $_GET['id']
])->find();

view('profile/show.view.php', [
    'title' => $title,
    'user' => $user
]);
