<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use App\Models\Post;

class Image extends Model
{
    use HasFactory;

    public function post()
    {
        return $this->belongsTo(Post::class); // belongsTo c'est l'inverse de hasOne: pour accéder au post à partir de l'image (comme la class commentaire)
    }
}
