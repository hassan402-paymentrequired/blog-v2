<?php
namespace App\Controller\Auth;
use App\Model\Database;
//dd($_SESSION);
class RegisterUserController
{

    public static function index()
    {
        if (isset($_SESSION['user'])){
            require base_path('resources/views/feed/index.view.php');
            exit();
        }
        require base_path('resources/views/auth/register.view.php');
    }

    public static function store()
    {
       // validate
        $username = trim(htmlentities($_POST['username']));
        $email = trim(htmlentities($_POST['email']));
        $password = trim(htmlentities($_POST['password']));

        if ( ! $username || ! $email || ! $password )
        {
            session('error', 'all fields are required');
            redirect('/');
        }

        $db = new Database();

        $checkIfUserExist =  $db->findByEmailOrFail($email);

        if(! $checkIfUserExist)
        {

            try
            {


                $hashPwd = password_hash($password, PASSWORD_BCRYPT);

                $data = $db->query("INSERT INTO users (username, email, password) VALUES (?,?,?)",
                    [$username, $email, $hashPwd]);


                redirect('/login');

            }catch (\Exception $e){
                session('connection', 'Your network connection is not stable');
                redirect('/');
//                dd($e->getMessage());
            }
        }

        session('error', 'email already taken');
        redirect('/');
    }

}