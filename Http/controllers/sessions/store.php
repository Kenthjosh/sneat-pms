<?php

use Core\App;
use Core\Authenticator;
use Core\Database;
use Http\Forms\LoginForm;

// Validate the form
$form = LoginForm::validate($attributes = [
    'email' => $_POST['email'],
    'password' => $_POST['password']
]);

$auth = new Authenticator;

$signedIn = $auth->attempt(
    $attributes['email'],
    $attributes['password']
);

if ($signedIn) {
    $user = App::resolve(Database::class)
        ->query('SELECT * FROM active_users_view WHERE email = :email', [
            'email' => $attributes['email']
        ])->find();

    $auth->login($user);

    redirect('/');
} else {
    // If the authentication fails, add an error message
    $form->error(
        'email',
        'These credentials do not match our records.'
    )->throw();
}
