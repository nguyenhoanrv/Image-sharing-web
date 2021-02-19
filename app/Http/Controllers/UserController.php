<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getNotifications()
    {
        return DB::table('notifications')->where('notifiable_id', Auth::id())->oldest()->get();
    }
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = (User::with('albums')->select('id', 'name', 'email', 'avatar')->find($id));
        $followers = DB::table('followers')->where('following_id', $id)->count();
        $followings = DB::table('followers')->where('follower_id', $id)->count();
        if (Auth::check()) {
            $me_id = auth()->user()->id;
            $is_following = FollowerController::amIFollowing($id);

            if ($user) {
                return view('profile', compact('user', 'is_following', 'followers', 'followings', 'me_id'));
            } else {
                abort(404);
            }

        }
        return view('profile', compact('user', 'followers', 'followings'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function notifications()
    {
        return User::find(1);
    }
}