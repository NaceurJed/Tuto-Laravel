@extends('layouts.app'){{-- Pour dire que cette vue se base sur le gabari (layouts) qui se trouve dans ce chemin (on n'a pas besoin de spécifier le dossier views mais comme app.blade.php est dans un sous dossier de views on doit le spécifier de cette maniére) --}}
 
@section('content') 
    {{-- le code entre les @section va se placer dans le fichier app.blade.php au niveau de l'instruction @yield --}}
    <h1 class="h4">Contenu du post:</h1> 
    <p>{{ $post->content }}</p>
    {{-- on récupére le content de post --}}

    {{-- On va récupérer les commentaires correspondant à un post de la table commentaire --}}

    <br>
    {{-- On raméne l'image de la table image --}}
    <h1 class="h4">Chemin de l'image:</h1>
    <span>{{ $post->image ? $post->image->path : "Pas d'image" }}</span> 
    {{-- on vérifie si $post->image est nom vide, alors on demande le path : si non affiche "Pas d'image --}}

    <br>
   
   <h1 class="h4">Liste commentaires:</h1>
   <ol>
    @forelse($post->commentaires as $commentaires) {{-- On va utiliser la méthode commentaires de la class Post qui nous renvoi un tableau commentaires, il faut donc par la suite récupérer juste la colonnes content qui contient les commentaires--}}
    {{-- pour le format date regarde: https://carbon.nesbot.com/docs/#api-formatting --}}
        <li>{{ $commentaires->content }} crée le: {{ $commentaires->created_at->format('d-m-Y') }} à {{ $commentaires->created_at->toTimeString() }} </li>
    @empty
        <p>Pas de commentaire pour ce post</p>
        
    @endforelse
    </ol>

    <hr>

    {{-- On va faire la relation entre les tags et les posts --}}
    <h1 class="h4">Liste des tags</h1>
    @forelse($post->tags as $tag)
        <p>{{ $tag->name }}</p>
    @empty
        <p>Pas de tag pour ce post</p>
    @endforelse

@endsection