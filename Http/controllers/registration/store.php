<?php

use Core\App;
use Core\Authenticator;
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

// Check if a user with the email already exists
$user = $db->query('SELECT * FROM tbl_users WHERE email = :email', [
    'email' => $_POST['email']
])->find();

$auth = new Authenticator;

// If a user with the email already exists, redirect back to the registration form
if ($user) {
    $auth->login($user);
    redirect('/');
    exit();
} else {
    $db->query('CALL register_new_user(:first_name, :middle_name, :last_name, :role, :email, :password)', [
        'first_name' => $_POST['first_name'],
        'middle_name' => $_POST['middle_name'],
        'last_name' => $_POST['last_name'],
        'role' => 'user',
        'email' => $_POST['email'],
        'password' => password_hash($_POST['password'], PASSWORD_DEFAULT) // You should never store passwords in plain text
    ]);

    $signedIn = $auth->attempt(
        $attributes['email'],
        $attributes['password']
    );

    if ($signedIn) {
        $user = $db->query('SELECT * FROM tbl_users WHERE email = :email', [
            'email' => $attributes['email']
        ])->find();

        $auth->login($user);
        redirect('/');
        exit();
    } else {
        // If the authentication fails, add an error message
        $form->error(
            'email',
            'These credentials do not match our records.'
        )->throw();
    }
}
