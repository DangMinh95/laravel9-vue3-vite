<?php

namespace App\Observers;

use App\Models\Comment;

class CommentObserver
{
    /**
     * Handle the Comment "created" event.
     *
     * @param Comment $comment
     * @return void
     */
    public function created(Comment $comment)
    {
        //
    }

    /**
     * Handle the Comment "updated" event.
     *
     * @param Comment $comment
     * @return void
     */
    public function updated(Comment $comment)
    {
        //
    }

    /**
     * Handle the Comment "deleted" event.
     *
     * @param Comment $comment
     * @return void
     */
    public function deleted(Comment $comment)
    {
        //
    }

    /**
     * Handle the Comment "restored" event.
     *
     * @param Comment $comment
     * @return void
     */
    public function restored(Comment $comment)
    {
        //
    }

    /**
     * Handle the Comment "force deleted" event.
     *
     * @param Comment $comment
     * @return void
     */
    public function forceDeleted(Comment $comment)
    {
        //
    }

    /**
     * Handle the Comment "retrieved" event.
     *
     * @param Comment $comment
     * @return void
     */
    public function retrieved(Comment $comment)
    {
        $comment->makeHidden(['commentable_id', 'commentable_type']);
    }
}
