<?php

use Core\Session;
$title = 'Register';

view('registration/create.view.php', [
    'errors' => Session::get('errors'),
    'title' => $title
]);
