<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Album;
use \App\Image;
class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $album = Album::with('images')->with('user:id,name,avatar')->findOrFail($id);
        return view('image.index', compact('album'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        if(Album::where('user_id', auth()->user()->id)->where('id', $id)->exists()){
            return view('image.create')->with('album_id', $id);
        } else {
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'images' => 'required',
            'images.*' => 'mimes:png,jpg,jpeg'
        ]);
        foreach ($request['images'] as $image){
            $imageName = $image->hashName();
            $image->move(public_path('images/albums'), $imageName);
            Image::create([
                'image' => $imageName,
                'album_id' => $request['album_id']
            ]);
        }
        
    }

    public function showImages($id) {
       
        
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