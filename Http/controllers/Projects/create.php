<?php

use Core\Session;

$title = 'Add new Project';

view('Projects/create.view.php', [
    'title' => $title,
    'errors' => Session::get('errors')
]);
