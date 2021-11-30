@extends('layouts.app')
 
@section('content') 
    <h1>Je suis la vue controlleur</h1>

		{{-- Grace à Blade: Ici on intercepte la variable $title envoyé par le controleur PostControleur.php --}}
		{{-- <h2>{{ $title }}</h2> 	si on utilise la fonction with dans le controleur on doit mettre la key entre double accoulade --}}
		{{-- <h2>{{ $title2 }}</h2> --}}


		{{-- Mais si on reçoi un tableau on va le gérer grace à @foreach ($tableau c'est le tableau tel qui est défini dans le controleur) --}}
		{{-- @foreach($tableau as $valeur)
			<h3>{{ $valeur }}</h3>
		@endforeach --}}

		{{-- On va ici afficher ce qu'on veut de la table Posts grace à la instruction $posts = Post::all(); --}}
	@if($posts->count() > 0)	
		@foreach($posts as $post)
			<h3><a href="{{ route('posts.show', ['id' => $post->id]) }}">{{ $post->title }}</a></h3> {{-- Ici on demande de ramener que le title --}}
			{{-- on va aussi pouvoir recupérer un id d'un post et aller sur une autre page (il faut créer la vue dans web.php): On spécifie dans le href la route avec l'id de cette maniére --}}
			
		@endforeach
	@else
		<span>Aucun post en base de donnée</span>
	@endif

@endsection