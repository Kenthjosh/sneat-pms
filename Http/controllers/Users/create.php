<?php

use Core\Session;
$title = 'Register';

view('Users/create.view.php', [
    'errors' => Session::get('errors'),
    'title' => $title
]);
