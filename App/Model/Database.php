<?php

namespace App\Model;
use PDO;

class Database
{
    protected $statement;

    public function __construct()    {
        try
        {
            $dsn = 'mysql:host=localhost;dbname=blog;charset=utf8mb4;port=3306;';
            $this->statement = new PDO($dsn, 'root', '', [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);


        } catch (\Exception $e){
            dd(['error'=>$e->getMessage()]);
        }

    }

    public function findByEmailOrFail($email)
    {
       $data =  $this->query("SELECT * FROM users WHERE email = :email", ['email'=>$email])->fetch();
       if($data){
           return $data;
       }

       return false;
    }

    public function query($sql , $params = [])
    {
        $statement = $this->statement->prepare($sql);

        $statement->execute($params);

        return $statement;
    }
}