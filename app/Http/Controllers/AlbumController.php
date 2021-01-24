<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Album;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('album.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('album.create');
    }

    
    public function getAlbums() {
        $albums = Album::where('user_id', auth()->user()->id)->with('category')->get();
        return $albums;
    }

    public function getAlbumById($id) {
        $album = Album::with('category')->findOrFail($id);
        return $album;
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
        'name' => 'required|min:2|max:255',
        'description' => 'required|max:255',
        'image' => 'required|mimes:png,jpg,jpeg',
        ]);
        $imageName = $request['image']->hashName();
        $request['image']->move(public_path('album'), $imageName);        
        $album = Album::create([
            'name' => $request['name'],
            'description' => $request['description'],
            'image' => $imageName,
            'slug' =>Str::slug($request['name']),
            'category_id' => $request['category_id'],
            'user_id' => auth()->user()->id
        ]);

        
        return response()->json(['id' => $album->id]);
        
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
    public function update( $id,Request $request)
    {
        //
        $validated = $request->validate([
        'name' => 'required|min:2|max:255',
        'description' => 'required|max:255',
        ]);
        
        $album = Album::find($id);
        $imageName = $album->image;
        if($request->hasFile('image')) {
            $imageName = $request['image']->hashName();
            $request['image']->move(public_path('album'), $imageName); 
        }
        $album->name = $request->name;
        $album->description = $request->description;
        $album->image = $imageName;
        $album->slug = Str::slug($request->name);
        $album->category_id = $request->category_id;
        $album->save();
        
        return response()->json($this->getAlbums());

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
        Album::destroy($id);
        return response()->json($this->getAlbums());
        
    }
}