<?php

namespace App\Controller\Likes;

use App\Model\Database;

class LikesController
{

    public static function store()
    {
        $pid = $_POST['post_id'];

        try {

            $db = new Database();

            $exist = $db->query("SELECT * FROM likes WHERE post_id = ? AND user_id = ?",
                [$pid,$_SESSION['user']['id']])->fetch();

            if ($exist){
                $db->query("DELETE FROM likes WHERE post_id = ? AND user_id = ?",
                    [$pid,$_SESSION['user']['id']]);

               $like =  $db->query("SELECT COUNT(*) AS like_count FROM likes WHERE post_id = ?", [$pid])->fetch();

                echo $like['like_count'];
                exit(200);
            }

            $db->query("INSERT INTO likes ( user_id, post_id ) VALUES (?,?)",
            [$_SESSION['user']['id'],$pid]);

            $like =  $db->query("SELECT COUNT(*) AS like_count FROM likes WHERE post_id = ?", [$pid])->fetch();

            echo $like['like_count'];
            exit(200);


        }catch (\Exception $exception){
            dd($exception);
        }
    }



}