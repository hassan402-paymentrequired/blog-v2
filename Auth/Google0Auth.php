<?php

namespace App\Controller\Auth;

use App\Model\Database;

class Google0Auth
{

    protected static $google_oauth_client_id = '982859065982-j9s4ab4l7n3qno5oriehgeasbqa21rg3.apps.googleusercontent.com';
    protected static $google_oauth_client_secret = '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';
    protected static $google_oauth_redirect_uri = 'http://localhost:4004/google-sign';

    public static function index()
    {
        if (isset($_GET['code']) && !empty($_GET['code'])) {


        $params = [
            'code' => $_GET['code'],
            'client_id' => self::$google_oauth_client_id,
            'client_secret' => self::$google_oauth_client_secret,
            'redirect_uri' => self::$google_oauth_redirect_uri,
            'grant_type' => 'authorization_code'
        ];


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://accounts.google.com/o/oauth2/token');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response, true);


        $google_oauth_version = 'v3';


        if (isset($response['access_token']) && !empty($response['access_token'])) {
            // Execute cURL request to retrieve the user info associated with the Google account
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://www.googleapis.com/oauth2/' . $google_oauth_version . '/userinfo');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $response['access_token']]);
            $response = curl_exec($ch);
            curl_close($ch);
            $profile = json_decode($response, true);

       

            $db = new Database();

            $checkIfUserExist = $db->findByEmailOrFail($profile['email']);

            if ($checkIfUserExist) {

                session('user', $checkIfUserExist);
                redirect('/home/feed');

            }

            session('error', 'No user with the credentials found on our record');
            redirect('/login');


        }else{
            dd('No access token');
        }









    } else {
        // Define params and redirect to Google Authentication page
        $params = [
            'response_type' => 'code',
            'client_id' => self::$google_oauth_client_id,
            'redirect_uri' => self::$google_oauth_redirect_uri,
            'scope' => 'https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile',
            'access_type' => 'offline',
            'prompt' => 'consent'
        ];
        header('Location: https://accounts.google.com/o/oauth2/auth?' . http_build_query($params));
        exit;
    }
    }

}