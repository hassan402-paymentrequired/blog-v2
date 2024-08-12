<?php

namespace App\Controller\Auth;

use App\Model\Database;

class AuthenticateUserController
{

    public static function index()
    {
        require base_path('resources/views/auth/login.view.php');
    }

    public static function store()
    {
        try {

            $email = trim(htmlentities($_POST['email']));
            $password = trim(htmlentities($_POST['password']));

            if (!$email || !$password) {
                session('error', 'all fields are required');
                redirect('/login');
            }


            $db = new Database();

            $checkIfUserExist = $db->findByEmailOrFail($email);

            if ($checkIfUserExist && password_verify($password, $checkIfUserExist['password'])) {

                session('user', $checkIfUserExist);
                redirect('/home/feed');

            }

            session('error', 'No user with the credentials found');
            redirect('/login');




        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public static function destroy()
    {
        $_SESSION = [];
        session_destroy();

        $params = session_get_cookie_params();

        setcookie('PHPSESSID','', time() - 3600, $params['path'], $params['domain'], $params['secure'],$params['httponly']);

        redirect('/');
    }

}