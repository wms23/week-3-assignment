<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'content', 'is_published', 'author_id'];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function getExcerptAttribute()
    {
        $exploded_string = explode(" ", $this->content);
        return collect($exploded_string)->take(30)->join(' ') . ' ...';
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopePostOwner($query)
    {
        return $query->where('author_id', \Auth::user()->id);
    }

    public function scopeDefaultOrder($query)
    {
        return $query->orderByDesc('created_at');
    }
}
