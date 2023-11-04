<?php

class CommentModel extends Db
{

    function getCommentsByPost($postId)
    {
        $sql = "select comment.*, user.user_image as user_image, user.username as username from comment join user on comment.user_id = user.id where image_id = ?";
        $values = array($postId);
        return $this->selectQuery($sql, $values);
    }

    function addComment($postId, $content, $userId)
    {
        $sql = "insert into comment (content, user_id, image_id) values (?,?,?)";
        $values = array($content, $userId, $postId);
        return $this->selectQuery($sql, $values);
    }
}


class PostModel extends Db
{
    function getPostbyId($id)
    {
        $sql = 'select art.id as id, image, user_id, username, user_image from art left join user on art.user_id = user.id where art.id = ?';
        $values = array($id);
        $data = $this->selectQuery($sql, $values);
        if (Count($data) > 0) return $data[0];

        return null;
    }

    function getCategorybyPostId($id)
    {
        $sql = 'select category.name from category left join art on category.id = art.category_id where art.id = ?';
        $values = array($id);
        return $this->selectQuery($sql, $values);
    }
}
