@extends('layouts.app')

@section('content')
<h1>Créer un nouveau post</h1>

{{-- Gestion des erreurs du formulaire --}}
{{-- any verifie si il y a au moins une erreur --}}
@if($errors->any())
{{-- on va avoir des messages en anglais, pour les traduire on va dans config/app.php et on modifie 'local' => 'fr' pour lui indiquer d'utiliser le fichier fr (il faut biensur le créer)
	- Puis dans resources/lang/en/ on a un fichier validation qui regroupe tous les massages d'erreur en anglais
	- On créer un dossier fr et on copie tous les fichers de en dans fr et traduire au fur et à mesure les messages d'erreurs

	*** - On peut aussi créer une nouvelle régle: en passant par le terminal " php artisan make:rule Uppercase "
		- ça va nous créer un fichier Uppercase.php dans le dossier rules (qu'il crée aussi) dans app 
		- On ouvre le fichiers et on trouve 3 méthodes
		- on va modifier la méthode passes qui renvoie un booleen true ou false en fonction de notre régle:
		  return strtoupper($value) === $value; ça va retourner true si $value est en MAJICULE
		- On modifie ensuite la méthode message: return 'le champ '.$attribute.' doit être en MAJISCULE';
		- on revient sur notre fichier qui traite le formulaire(PostControleur) pour ajouter cette régle, et cette fois nous avons besoin de passer nos régle avec un tableau: 'title' => ['required', 'min:5', 'max:20', 'unique:posts', new Uppercase]
		- SANS OUBLIER le use App\Rules\Uppercase;
		--}}
	@foreach($errors->all() as $error)
		<div class="text-danger">{{ $error }}</div>
	@endforeach
@endif

<form method="POST" action="{{ route('posts.store') }}">
	{{-- il faut rajouter un jeton csrf pour nous protéger des fails web (génére un token), car laravel ne va pas accepter tout ce qui arrive du protocole POST--}}
	@csrf 
	<div class="input-group mb-3 row">
	  <span class="input-group-text col-1" id="basic-addon1">Title</span>
	  <input type="text" name="title" class="form-control" aria-label="Username" aria-describedby="basic-addon1">
	</div>
	<div class="input-group row">
	  <span class="input-group-text col-1">Content</span>
	  <textarea class="form-control" aria-label="With textarea" name="content"></textarea>
	</div>

	<button type="submit" class="btn btn-primary m-2">Créer</button>
	
</form>
@endsection