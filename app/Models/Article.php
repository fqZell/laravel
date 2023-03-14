<?php

namespace App\Models;
use Illuminate\Support\Facades\Storage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'short_text',
        'image_path',
        'view_count',
        'is_published',
        'author_id',
    ];

    public function author()
    {
        return $this->hasOne(User::class, 'id', 'author_id')->first();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'article_id', 'id')->get();
    }

    public function getImageUrlAttribute()
    {
        return url(Storage::url($this->image_path));
    }
}
