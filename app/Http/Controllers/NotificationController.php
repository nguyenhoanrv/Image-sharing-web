<?php

namespace App\Http\Controllers;

use App\Notifications\CommentNotification;
use App\Notifications\ReplyCommentNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use App\Album;
class NotificationController extends Controller
{
    //
    // hoan da comment album name cua t
    static public function notify_comment(Request $request){
        $album = Album::with('user:id,name')->findOrFail($request->album_id);
        $users_comment_id = DB::table(DB::raw('comments c, users u '))
        ->selectRaw('c.user_id as user_id')->where('c.album_id', $request->album_id)->where('c.user_id', '=', DB::raw('u.id'))->where('c.user_id', '!=', auth()->user()->id)->distinct()->get();
        if(!$request->has('par_id')){
        //      $users_comment_id = DB::table(DB::raw('comments c, users u '))
        // ->selectRaw('c.user_id as user_id')->where('c.album_id', $request->album_id)->where('c.user_id', '=', DB::raw('u.id'))->groupBy('user_id')->get()->toArray();
        foreach($users_comment_id as $user_id){
            $user = User::find($user_id->user_id);
            $user->notify(new CommentNotification(auth()->user()->name,$album->name, $album->id, $album->user->name));
        }
        } else {
            foreach($users_comment_id as $user_id){
            $user = User::find($user_id->user_id);
            $user->notify(new ReplyCommentNotification(auth()->user()->name,$album->name, $album->id, $album->user->name, $request->par_user_name));
        }
        }
    }
}