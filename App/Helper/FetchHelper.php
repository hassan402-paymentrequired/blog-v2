<?php

namespace App\Helper;

use App\Model\Database;

class FetchHelper
{


    public static function fetch($limit = 0)
    {
        $db = new Database();

        if ($limit > 0) {

            return  $data = $db->query("SELECT
            posts.id AS post_id,
            posts.title AS post_title,
            posts.tag AS post_tag,
            posts.body AS post_body,
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
        GROUP BY
            posts.id, users.id
        ORDER BY
            posts.created_at DESC LIMIT {$limit}")->fetchAll();


        } else {

            return  $data = $db->query("SELECT
            posts.id AS post_id,
            posts.title AS post_title,
            posts.tag AS post_tag,
            posts.body AS post_body,
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
        GROUP BY
            posts.id, users.id
        ORDER BY
            posts.created_at DESC")->fetchAll();
        }
    }
}
