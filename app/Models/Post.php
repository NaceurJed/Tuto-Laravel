<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Commentaire;//ATTENTION: rajouter le use\... pour atteindre la classe Commentaire
use App\Models\Image; //pour atteindre la class image
use App\Models\Tag; //pour atteindre la class tag

class Post extends Model
{
    use HasFactory;
    /* Pour pouvoir remplir les champs title et content on doit lui demander*/
    protected $fillable = ['title', 'content']; // je veux qur tu remplisse title et content qaund jte le demande par la fonction create()

    //On rajoute cette fonction: 
    public function commentaires() // ici on a mis un s pour commentaire car on aura plusieurs commentaires pour un
    {
        return $this->hasMany(Commentaire::class); // hasMany : un post qui détient plusieur commentaires
    }

    public function image() // ici on a mis un s pour commentaire car on aura plusieurs commentaires pour un
    {
        return $this->hasOne(Image::class); // hasOne : un post qui détient une image
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

}
