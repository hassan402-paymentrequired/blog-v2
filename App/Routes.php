<?php

namespace App;


class Routes
{

    protected $getRoutes = [];
    protected $postRoutes = [];

    public function get($uri, $fn)
    {
        $this->getRoutes[$uri] = $fn;
    }

    public function post($uri, $fn)
    {
        $this->postRoutes[$uri] = $fn;
    }

    public function resolve()
    {
        $method = $_SERVER['REQUEST_METHOD'] ?? null;
        $uri = $_SERVER['PATH_INFO'] ?? null;

        if ($method === 'GET')
        {
            $fn = $this->getRoutes[$uri];
        }
        else
        {
            $fn = $this->postRoutes[$uri];
        }


        if ($fn)
        {
            call_user_func($fn);
        }
        else
        {
            abort(404);
        }

    }


    public function auth($auth, Routes $routes)
    {
      if($auth === 'auth')
      {
          if (isset($_SESSION['user'])){
             require_once $routes;
          }
      }

    }
}