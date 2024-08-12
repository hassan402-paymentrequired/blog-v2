<?php
session_start();
function dd($values)
{
    echo "<pre>";
    var_dump($values);
    echo "</pre>";

    die();
}

function redirect($path)
{
     header('Location: ' . $path);
     exit();
}

function session($key, $value)
{
    $_SESSION[$key] = $value;
}

function abort($code = 404)
{
    http_response_code($code);
    require base_path("resources/views/components/error.php");
    die();
}

function base_path($path)
{
    return __DIR__ . "/../". $path;
}

function getFirstTwoLetters($string) {
    return substr($string, 0, 2);
}

function view($view)
{
    return base_path('resources/views'. $view);

}
// /blog-posts/index.view.php
