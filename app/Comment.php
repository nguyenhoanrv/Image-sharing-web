<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $fillable = [
        'par_id', 'user_id', 'album_id', 'content',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function album()
    {
        return $this->belongsTo(Album::class);
    }
}