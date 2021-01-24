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

}