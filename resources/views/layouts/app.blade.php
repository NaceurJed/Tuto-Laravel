<!DOCTYPE html>
{{-- Cette page va rassembler toute les vues => on va introduire les autres vues ici en fonction de ce que demande l'utilisateur --}}
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}"> {{-- c'est le fichier app.css dans resources qu'il faut modifier pour le style. (ça va se compiler automatiquement à chaque enregistrement car nous avons fait npm run watch) --}}
		{{ asset('css/app.css') }}
		{{-- asset('css/app.css') va ramener le lien du fichier app.css qui est "http://localhost/Formation%20ICS/16-%20Laravel/tutoYoutube/public/css/app.css"--}}
		<title>Mon site</title>
	</head>
	<body>
		@include('partials.navbar') 	{{-- on indique le chemin vers la navbar dans l'include --}}
		<div class="text-center">
			<h2 class="text-danger">Ce titre est sur la page du layout</h2>
		</div>
		
		@yield('content'){{-- Pour dire qu'il y a un contenu dynamique qui va se placer ici et qui s'appelle content (voir le fichier welcome) --}}

		<script src="{{ asset('js/app.js') }}"></script> {{-- pareil pour le js --}}
		{{ asset('js/app.js') }} {{-- ça affiche le chemin du fichier app.js --}}
	</body>
</html>