@extends('layouts.app'){{-- Pour dire que cette vue se base sur le gabari (layouts) qui se trouve dans ce chemin (on n'a pas besoin de spécifier le dossier views mais comme app.blade.php est dans un sous dossier de views on doit le spécifier de cette maniére) --}}
 
@section('content') 
    {{-- le code entre les @section va se placer dans le fichier app.blade.php au niveau de l'instruction @yield --}}
    <h1>Page d'accueil</h1>
@endsection
