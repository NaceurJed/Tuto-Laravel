<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;//ATTENTION: rajouter le use\... pour atteindre la classe post

class commentaire extends Model
{
    use HasFactory;

    //On rajoute cette fonction:
    public function post() // ici on n'a pas mis un s pour post car on aura un seul post pour plusieurs commentaires
    {
        return $this->belongsTo(post::class); // hasMany : un post qui détient plusieur commentaires
        //post::class permet de retourner la chaine de caractére 'App\Model\Post'
        
    }
}
