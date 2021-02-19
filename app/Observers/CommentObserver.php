<?php

namespace App\Observers;

use App\Comment;
use App\Events\SendCommentEvent;
use App\Notifications\CommentNotification;
use App\Notifications\ReplyCommentNotification;
use App\User;
use Illuminate\Support\Facades\DB;

class CommentObserver
{
    /**
     * Handle the comment "created" event.
     *
     * @param  \App\Comment  $comment
     * @return void
     */
    public function created(Comment $comment)
    {
        $users_comment_id = DB::table(DB::raw('comments c, users u '))
            ->selectRaw('c.user_id as user_id')->where('c.album_id', $comment->album_id)->where('c.user_id', '=', DB::raw('u.id'))->where('c.user_id', '!=', auth()->user()->id)->distinct()->get();
        if ($comment->par_id != null) {
            $comment_par = Comment::find($comment->par_id);
            foreach ($users_comment_id as $user_id) {
                $user = User::find($user_id->user_id);
                $user->notify(new ReplyCommentNotification($comment->user->name, $comment->album->name, $comment->album->id, $comment->album->user->name, $comment_par->user->name, $comment->user->avatar));
            }
        } else {
            foreach ($users_comment_id as $user_id) {
                $user = User::find($user_id->user_id);
                $user->notify(new CommentNotification($comment->user->name, $comment->album->name, $comment->album->id, $comment->album->user->name, $comment->user->avatar));

            }

        }
        $rs = [
            'id' => $comment->id,
            'content' => $comment->content,
            'par_id' => $comment->par_id,
            'user_id' => $comment->user_id,
            'user_name' => $comment->user->name,
            'avatar' => $comment->user->avatar,
        ];
        event(new SendCommentEvent($rs));
    }
    /**
     * Handle the comment "updated" event.
     *
     * @param  \App\Comment  $comment
     * @return void
     */
    public function updated(Comment $comment)
    {
        //
    }

    /**
     * Handle the comment "deleted" event.
     *
     * @param  \App\Comment  $comment
     * @return void
     */
    public function deleted(Comment $comment)
    {
        //
    }

    /**
     * Handle the comment "restored" event.
     *
     * @param  \App\Comment  $comment
     * @return void
     */
    public function restored(Comment $comment)
    {
        //
    }

    /**
     * Handle the comment "force deleted" event.
     *
     * @param  \App\Comment  $comment
     * @return void
     */
    public function forceDeleted(Comment $comment)
    {
        //
    }
}