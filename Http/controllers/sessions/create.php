<?php

use Core\Session;

$title = 'Login';

view ('sessions/create.view.php', [
    'errors' => Session::get('errors'),
    'title' => $title
]);
