<?php
$header = 'Welcome ' . $_SESSION['user']['first_name'] . ' ' . $_SESSION['user']['middle_name'] . ' ' . $_SESSION['user']['last_name'];
$title = checkRole($_SESSION['user']['role'] === 'admin') ? 'Admin Dashboard' : 'Dashboard';

view('index.view.php', [
    'header' => $header,
    'title' => $title
]);
