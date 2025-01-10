<?php

namespace Core;

class Authenticator
{
    public function attempt($email, $password)
    {
        $user = App::resolve(Database::class)
            ->query('SELECT * FROM tbl_users WHERE email = :email', [
                'email' => $email
            ])->find();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                return true;
            }
        }

        return false;
    }


    public function login($user)
    {

        $_SESSION['user'] = [
            'uuid' => $user['UUID'],
            'role' => $user['roles'],
            'first_name' => $user['first_name'],
            'middle_name' => $user['middle_name'],
            'last_name' => $user['last_name'],
            'email' => $user['email'],
            'created_at' => $user['created_at'],
            'updated_at' => $user['updated_at'],
        ];
        // dd($_SESSION['user']);
        session_regenerate_id(true);
    }

    public function logout()
    {
        Session::destroy();
    }
}
