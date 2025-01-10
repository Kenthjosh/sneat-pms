<?php

use Core\App;
use Core\Database;
use Http\Forms\RegisterForm;

$form = RegisterForm::validate($attributes = [
    'first_name' => $_POST['first_name'],
    'middle_name' => $_POST['middle_name'],
    'last_name' => $_POST['last_name'],
    'email' => $_POST['email'],
    'password' => $_POST['password'],
    'confirm_password' => $_POST['confirm_password']
]);

// Resolve the database instance
$db = App::resolve(Database::class);

$db->query('CALL register_new_user(:first_name, :middle_name, :last_name, :role, :email, :password)', [
    'first_name' => $_POST['first_name'],
    'middle_name' => $_POST['middle_name'],
    'last_name' => $_POST['last_name'],
    'role' => $_POST['role'],
    'email' => $_POST['email'],
    'password' => password_hash($_POST['password'], PASSWORD_DEFAULT) // You should never store passwords in plain text
]);

redirect('/user');
