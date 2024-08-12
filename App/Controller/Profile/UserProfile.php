<?php

namespace App\Controller\Profile;

use App\Model\Database;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class UserProfile
{
    public static function index()
    {
        try {
            $db = new Database();

            $data =  $db->query("SELECT * FROM posts WHERE user_id = ?", [$_SESSION['user']['id']])->fetchAll();
        } catch (\Exception $exception) {
            dd($exception->getMessage());
        }

        require base_path('resources/views/profile/index.view.php');
    }

    public static function edit()
    {
        require base_path('resources/views/profile/edit.view.php');
    }

    public static function update()
    {

        try {

            $email = trim(htmlentities($_POST['email']));
            $username = trim(htmlentities($_POST['text']));

            if (! $email || ! $username) {
                session('error', 'all fields are required');
                redirect('/profile/update');
            };

            $db = new Database();

            $db->query(
                "UPDATE users SET username = ? , email = ? WHERE id = ?",
                [$username, $email, $_SESSION['user']['id']]
            );

            $user = $db->query("SELECT * FROM users WHERE id = ?", [$_SESSION['user']['id']])->fetch();

            session('user', $user);

            redirect('/profile');
        } catch (\Exception $exception) {
            dd($exception->getMessage());
        }
    }

    public static function resetPassword()
    {

        $email = trim(htmlentities($_POST['email']));

        $otp = $randomNumber = mt_rand(1000, 9999);

        if (! $email) {
            session('error', 'email required');
            redirect('/profile');
        }
        try {

            $db = new Database();

            $exist = $db->query('SELECT * FROM users WHERE email = ?', [$email])->fetch();

            if (! $exist) {
                session('error', 'No user with email found');
                redirect('/profile');
            }

            $db->query('UPDATE users SET otp = ? WHERE email = ?', [$otp, $email,]);





            $phpmailer = new PHPMailer();
            $phpmailer->isSMTP();
            $phpmailer->Host = 'sandbox.smtp.mailtrap.io';
            $phpmailer->SMTPAuth = true;
            $phpmailer->Port = 2525;
            $phpmailer->Username = '0d72af60cb2b12';
            $phpmailer->Password = '061d54979afd60';

            //Recipients
            $phpmailer->setFrom('from@example.com', 'Mailer');
            $phpmailer->addAddress($email, 'The village');     //Add a recipient


            //Content
            $phpmailer->isHTML(true);                                  
            $phpmailer->Subject = 'The village blog';
            $phpmailer->Body    = 'Hi there, this is your password reset pin <b>'. $otp . '</b>';

            $phpmailer->send();

            redirect('/reset');
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$e->getMessage()}";
        }
    }

    public static function reset()
    {
        require base_path('resources/views/profile/reset.view.php');
    }

    public static function verify() : void
    {

        try {

            $otp = trim(htmlspecialchars($_POST['otp']));

            if ( ! $otp) {
                session('otp', 'Invalid OTP');
                redirect('/reset');
            }

            $db = new Database();

            $doesExist = $db->query('SELECT * FROM users WHERE id = ? AND otp = ?', [$_SESSION['user']['id'] , $otp])->fetch();

            if ($doesExist){
                session('success', 'You can now reset your password');
                redirect('/reset/password');
            }


        } catch (\Throwable $th) {
            //throw $th;
        }
        
    }

    public static function passwordReset() : void
    {
        require base_path('resources/views/profile/password-reset.view.php');

    }

    public static function passwordResets() : void
    {
        $password1 = trim(htmlspecialchars($_POST['password-1']));
        $password2 = trim(htmlspecialchars($_POST['password-2']));

        if ( ! $password1 || ! $password2) {
            session('password', 'Both password field is required');
            redirect('/reset/password');
        }

        if ( $password1 !== $password2 ) {
            session('password', 'Both password not match');
            redirect('/reset/password');
        }

        try {
            
            $db = new Database();   

            $hashPwd = password_hash($password1, PASSWORD_BCRYPT);

            $db->query('UPDATE users SET password = ? WHERE id = ?', [$hashPwd, $_SESSION['user']['id']]);
            
            session('success', 'Password updated successfully');

            redirect('/profile');

        } catch (\Throwable $th) {
            dd($th->getMessage());
        }

    }

    public static function guestPassword() : void
    {
        require base_path('resources/views/profile/password-guest-reset.view.php');
    }
}
