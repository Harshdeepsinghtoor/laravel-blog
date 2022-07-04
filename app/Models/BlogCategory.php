<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class BlogCategory extends Model
{
    protected $fillable = ['catname', 'catslug'];

    use HasFactory;
    use Sluggable;


    public function sluggable(): array
    {
        return [
            'catslug' => [
                'source' => 'catname'
            ]
        ];
    }

    public function postsfromcategory()
    {
        return $this->hasMany(BlogPost::class, 'catname', 'id');
    }
}
