<?php

namespace App\Repositories\Comment;

use App\Models\Product;
use App\Repositories\Comment\CommentRepositoryInterface;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentRepository implements CommentRepositoryInterface
{

    /**
     * @return mixed
     */
    public function createComment($params, $idProduct)
    {
        Comment::create([
            'commentable_id' => $idProduct,
            'user_id' => Auth::id(),
            'content' => $params['content'],
            'commentable_type' => config('common.modelsPath') . $params['model'],
            'likes' => 0
        ]);
    }

    /**
     * @return mixed
     */
    public function deleteComment($id)
    {
        Comment::where('id', $id)->delete();
    }

    /**
     * @return mixed
     */
    public function like($params, $id)
    {
        $comment = Comment::findorFail($id);
        $likes = $comment->likes;
        if ($params['like']) {
            $likes += 1;
        } else {
            $likes -= 1;
        }
        $comment->likes = $likes;
        $comment->save();
    }

    /**
     * @return mixed
     */
    public function getCommentInProduct($id)
    {
        $comment = Product::find($id)->comments()->get();
        $comment->makeHidden(['commentable_id', 'commentable_type']);
        return $comment;
    }

    public function deleteCommentOfProduct($id)
    {
        Comment::where('product_id', $id)->delete();
    }
}
