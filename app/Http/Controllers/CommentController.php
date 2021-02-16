<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Comment;

class CommentController extends Controller
{
    //
    public function store(Request $request){
         $validated = $request->validate([
        'content' => 'required',
        'album_id' => 'required',
        ]);
        
        $comment = new Comment();
        
        $comment->fill($request->all());
        $comment->user_id = auth()->user()->id;
        $comment->save();
        // $comment = DB::table(DB::raw('comments c, users u '))
        // ->selectRaw('c.id as id,c.content as content, c.user_id as user_id, c.par_id as par_id, u.name as user_name, u.avatar as avatar')->where('c.album_id', $request->album)->where('c.user_id', '=', DB::raw('u.id'))->orderByDesc('id')->finn($comment->id);
        return response()->json($comment);
    }
    
    public function getComments(Request $request) {
        $comments = DB::table(DB::raw('comments c, users u '))
        ->selectRaw('c.id as id,c.content as content, c.user_id as user_id, c.par_id as par_id, u.name as user_name, u.avatar as avatar')->where('c.album_id', $request->album)->where('c.user_id', '=', DB::raw('u.id'))->orderByDesc('id')->get();
        $comments_par = [];
        $comments_child = [];
        foreach($comments as $comment){
            if($comment->par_id == -1){
                foreach($comments as $cm) {
                    if($comment->id == $cm->par_id){
                        array_push($comments_child, $cm);
                    }
                }
                array_push($comments_par, ['comment_par' => $comment, 'comments_child'=>$comments_child]);
                $comments_child = [];
            }
        } 
        return response()->json($comments_par);
    }
}