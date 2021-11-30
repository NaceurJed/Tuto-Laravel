<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostControleur;//on utilise ce namespace pour pouvoir utiliser directement la class PostControleur

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () { //le '/' n'est pas obligatoire. function() est une fonction annonyme qui n'a pas de nom et qui renvoi la fonction view qui prend en paramétre la chaine de caractére 'welcome' = la vue welcome: welcome.blade.php
    return view('welcome');
});

//On peut renvoyer autre chose:
Route::get('/post', function(){
    return 'Bonjour toi'; 
}); //si on essaye d'accéder à /post on peut renvoyer une phrase

//on peut renvoyer une réponse en Json
Route::get('/post2', function(){
    return response()->json([
        'Nom' => 'Naceur',
        'Prenom' => 'JEDDI'
    ]); //on appel la fonction response avec json et lui passer des données
});

//On peut retourner une autre vue
Route::get('/article', function(){
    return view('article'); //il faut effectivement créer la vue article.blade.php dans le dossier ressource/view
});

/***** ATTENTION ce n'est pas optimiser de procéder de cette maniére, cad renvoyer directement la vue *****/
//On va donc utiliser les controller de Laravel qui vont étendre d'une classe controller et qui contiennent des fonctionnalités

/*
 - On crée le chemin vers la vue (Route/web.php)
 - On crée la vue (resources/views)
 - On crée le controleur dans (app/Http/Controllers) que j'ai appelé PostControleur.php 
*/
// Route::get('/controleur', 'App\Http\Controllers\PostControleur@index'); //dans le 2éme argument on va préciser le controleur (le namespace complet) et on sépare la fonction appelée avec @.
//Une autre maniére de faire c'est d'appeler directement la classe dans le 2éme argument (dans un tableau) mais d'abord apporter le namespace grace à use tout en haut
Route::get('/controleur', [PostControleur::class, 'index']);

/****** tuto BLADE: on va créer 4 pages (donc 4 routes)  ******/
Route::get('/controleur', [PostControleur::class, 'index'])->name('controleur');//le name permet de le saisir dans le href de la page navbar pour que lien soit dynamique est modifiable qu'à partir d'ici. On peut saisir ce qu'on veut à la place de /controleur car ça va nous renvoyé vers tjr làba

/*Page de création*/
Route::get('/post/create', [PostControleur::class, 'create',])->name('posts.create');//ATTENTION mettre cette route avant la route Route::get('/page2/{id?} pour pas prendre create pour un id

/*Route en post pour le formulaire*/
Route::post('/post/create', [PostControleur::class, 'store',])->name('posts.store');

/*Si nous avons un paramétre dans l'URL, on peut le traiter avec request
Route::post('/post/create/{name}', [PostControleur::class, 'store',])->name('posts.store');
//Il faut l'indiquer dans la fonction store de PostControleur
*/


Route::get('/page2/{id?}', [PostControleur::class, 'show',])->name('posts.show'); // le name de la route sera dans le href de la page controleur.blade.php. Il faut dans la classe PostControleur modifer la fonction show pour qu'elle récupére l'id

//Route::get('/page2/{id?}', [PostControleur::class, 'show',])->whereNumber('id');//pour récupérer une donnée spécifique on doit lui passer un id dans la route. Comme le id doit être un nombre, on peut déjà ici faire un controle grace aux Contraintes d'expressions régulières (voir doc laravel). Ici on demande si c'est un nombre. Donc cette route ne sera empreintée que si le id est un nombre, si non ERREUR 404



Route::get('/contact', [PostControleur::class, 'contact'])->name('contact');
Route::get('/welcome', [PostControleur::class, 'accueil'])->name('welcome');

/**** Ici on doit a chaque fois taper le lien dans la barre url pour accéder aux différente pages ****/
/*
 On va donc inclure le systéme de "include" qui va permettre d'isoler la barre de navigation.
 Au niveau de view on va créer un nouveau dossier: "partials", qui contient les parties que je inclure dans différente partie de blade
 Nous avons crée le fichier navbar.blade.php qui va contenir les différents liens des pages de mon sites*/ 