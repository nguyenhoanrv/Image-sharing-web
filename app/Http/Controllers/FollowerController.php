<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Notifications\UserFollowed;

use App\Follower;
use App\User;
class FollowerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
            $user_id = auth()->user()->id;
            if($request->is_following == 'false') {
                $follow = new Follower();
                $follow->fill($request->all());
                $user = User::find($request->following_id);
                $follow->follower_id =$user_id;
                $follow->save();
                $user->notify(new UserFollowed(auth()->user()));

        } else {
            
            Follower::where('following_id', $request->following_id)->where('follower_id', $user_id)->delete();
        }
        return response()->json();
    }
    
    static public function amIFollowing($id){
        $user_id = auth()->user()->id;
        return DB::table('followers')->where('following_id', $id)->where('follower_id', $user_id)->exists();
    }
    public function getFollowers($id){
        $followers_id = Follower::where('following_id', $id)->pluck('follower_id');
        // dd($followers);
        $users = [];
        foreach($followers_id as $follower_id) {
            $user = User::select('name','id', 'avatar')->where('id', $follower_id)->first();
            $is_following = Auth::check() ? $this->amIFollowing($follower_id) : false;
            array_push( $users, [$user, $is_following]);

        }
        return response()->json($users);
    }
    public function getFollowings($id){
        $followings_id = Follower::where('follower_id', $id)->pluck('following_id');
        $users = [];
        foreach($followings_id as $following_id) {
            $user = User::select('name','id', 'avatar')->where('id', $following_id)->first();
            $is_following = $this->amIFollowing($following_id);
            array_push( $users, [$user, $is_following]);
        }
        return response()->json($users);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
}