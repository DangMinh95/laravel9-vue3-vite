<?php

namespace App\Repositories\Comment;

interface CommentRepositoryInterface
{
    public function createComment($params, $idProduct);

    public function deleteComment($id);

    public function deleteCommentOfProduct($id);

    public function like($params, $id);

    public function getCommentInProduct($id);
}
