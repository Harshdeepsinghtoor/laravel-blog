<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class BlogPost extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = ['title', 'body', 'user_id', 'photo', 'publish', 'catname', 'slug'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function category()
    {
        return $this->hasOne(BlogCategory::class, 'id', 'catname', 'catslug',);
    }
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
