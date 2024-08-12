<?php

namespace App\Controller\Posts;

use App\Helper\FetchHelper;
use App\Model\Database;

class BlogPostsController
{

    public static function index()
    {

        try {
            $db = new Database();

          $data =  FetchHelper::fetch();

            
        } catch (\Exception $exception) {
            dd($exception->getMessage());
        }





        require base_path('resources/views/blog-posts/index.view.php');
    }



    public static function create()
    {
        require base_path('resources/views/feed/index.view.php');
    }

    public static function store()
    {
        try {

            $title = trim(htmlentities($_POST['title']));
            $content = trim(htmlentities($_POST['body']));
            $tag = trim(htmlentities($_POST['tag']));

            if (!$title || !$content) {
                session('error', 'both fields are required');
                redirect('/home/feed/create');
            }

            $db = new Database();


            $db->query(
                "INSERT INTO posts (user_id, title, body, tag) VALUES (?,?,?, ?)",
                [$_SESSION['user']['id'], $title, $content, $tag]
            );

            session('success', 'Post added successfully');
            redirect('/home/feed');
        } catch (\Exception $exception) {
            dd($exception->getMessage());
        }
    }

    public static function show()
    {
        try {

            $id = $_GET['id'];

            $db = new Database();

            $data = $db->query("SELECT
            posts.id AS post_id,
            posts.title AS post_title,
            posts.body AS post_body,
            posts.tag AS post_tag,
            posts.created_at AS post_created_at,
            users.id AS user_id,
            users.username AS username,
            users.email AS user_email,
            (SELECT COUNT(*) FROM likes WHERE likes.post_id = posts.id) AS like_count,
            CONCAT('[', 
                IFNULL(
                    GROUP_CONCAT(
                        CONCAT(
                            '{\"comment_id\":', comments.id, 
                            ',\"comment_title\":\"', comments.title, 
                            '\",\"comment_created_at\":\"', comments.created_at,
                            '\",\"comment_user_id\":', comment_users.id, 
                            ',\"comment_username\":\"', comment_users.username,
                            '\",\"comment_user_email\":\"', comment_users.email, '\"}'
                        ) SEPARATOR ','
                    ), 
                '') ,']') AS comments
        FROM
            posts
        JOIN
            users ON posts.user_id = users.id
        LEFT JOIN
            comments ON posts.id = comments.post_id
        LEFT JOIN
            users AS comment_users ON comments.user_id = comment_users.id
        WHERE
                posts.id = ?
        GROUP BY
            posts.id, users.id
        ORDER BY
            posts.created_at DESC", [$id])->fetch();

            require base_path('resources/views/blog-posts/show.view.php');
        } catch (\Exception $exception) {
            dd($exception->getMessage());
        }
    }

    public static function update()
    {
        try {

            $id = trim(htmlentities($_POST['id']));
            $title = trim(htmlentities($_POST['title']));
            $content = trim(htmlentities($_POST['body']));
            $tag = trim(htmlentities($_POST['tag']));

            if (!$title || !$content || !$tag) {
                session('error', 'both fields are required');
                redirect('/home/feed/edit?id='. $id);
            }

            $db = new Database();


            $db->query(
                "UPDATE posts SET title = ? , body =? , tag = ? WHERE id = ?",
                [ $title, $content, $tag, $id ]
            );

            session('success', 'Post updated successfully');
            redirect('/profile');


        } catch (\Exception $exception) {
            dd($exception->getMessage());
        }
    }

    public static function edit()
    {
        $id = $_GET['id'];

        try {
            $db = new Database();

            $data = $db->query('SELECT * FROM posts WHERE id = ?', [$id])->fetch();



        } catch (\Throwable $th) {
            //throw $th;
        }



        require view('/blog-posts/edit.view.php');
    }

    public static function destroy()
    {
        $id = $_POST['id'];  

        try {
            $db = new Database();

            $db->query("DELETE from posts WHERE id = ?", [$id]);

            redirect('/profile');

        } catch (\Throwable $th) {
            dd('Error:'. $th->getMessage());
        }
    }

    public static function search()
    {
        $search = trim(htmlentities($_POST['search']));


        try {

            $db = new Database();

            $query = 'SELECT posts.*, users.username, users.email 
            FROM posts 
            JOIN users ON posts.user_id = users.id 
            WHERE posts.title LIKE ? 
            OR posts.body LIKE ? 
            OR posts.tag LIKE ?';

            $searchParam = "%" . $search . "%";
            $data = $db->query($query, [$searchParam, $searchParam, $searchParam])->fetchAll();

            require base_path('resources/views/blog-posts/search.view.php');

        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
