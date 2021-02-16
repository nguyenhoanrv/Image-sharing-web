<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable = [
        'name', 'description', 'image','category_id', 'user_id', 'slug'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
     public function images()
    {
        return $this->hasMany(Image::class);
    }
     public function user()
    {
        return $this->belongsTo(User::class);
    }

     public function comments()
    {
        return $this->hasMany(Comment::class);
    }


}