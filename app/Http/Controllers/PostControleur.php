<?php
//on nome le chemin où se trouve notre controlleur dans le namespace
namespace App\Http\Controllers;

use App\Models\Post; //on importe la classe Post pour pouvoir l'utiliser et recupérer les données de la table posts
use Illuminate\Http\Request; // ce request est un super objet, recupére les info depuis le protocole http, regarde la fonction store en bas
use App\Rules\Uppercase;
//On crée notre classe PostControleur qui hérite de la classe Controller présente dans le même dossier
/*
 Ici nous avons crée la class PostControleur manuellement. Mais on peut le créer automatiquement en passant le terminal:
 php artisan make:controller PostControleur
*/

class PostControleur extends Controller
{
	//on crée une fonction qui va gérer notre vue controleur
	public function index()
	{
		/***** On va pouvoir passer des données: ******/
		$title = 'Mon super premier titre';// pour envoyer le title on va passer en 2éme paramétre de la fonction view une fonction compact qui prend en paramétre le nom de la variable qu'on veut passer: ici 'title'
		$title2 = 'Mon super second titre'; //on peut passer plusieur données en les citant dans la fonction compact séparé par virgule

		/* return view('controleur', compact('title', 'title2'));*/ // c'est grace au controlleur qu'on va renvoyé la vue et pas directement avec la route (web.php)
		//on peut mettre en 2éme paramétre les données à envoyer à la vue controleur.blade.php
		//Pour envoyer plusieur paramétre on peut le faire comme ça aussi (avec un tableau):
		/*
		return view('controleur', [
			'title'=> $title,
			'title2' => $title2
		]);
		*/

		/***** une autre façon de faire en utilisant la fonction with(key, $value): *****/
		/* return view('controleur')->with('title', $title);*/ //Attention c'est la key 'title' (pas $title) qu'on doit spécifier dans la vue entre double accoulade


		/***** Enfait les données sont généralement stockée dans des tableaux *****/
		$tableau = [
			'Premier titre',
			'Deuxiéme titre'
		]; 
		//return view('controleur', compact('tableau'));// Et on envoi le tableau

		/*OU*/
		/*
		return view('controleur', [
			'tableau' => $tableau
		]);
		*/

		/******* Eloquent: on va récupérer nos données de la base de donnée *******/
		// On va stocker dans une variable $posts
		$posts = Post::all(); //on utilise le model Post avec la fonction all() pour récupérer toutes les données de la table posts
		//On peut faire $posts = Post::orderBy('title')->get(); pour avoir tous les enregistrement ordonnés par le titre
		//$posts = Post::orderBy('title')->take(3)->get(); pour recupérer que 3 enregistrement
		// dd($posts); // die and dupm de posts, pour afficher comme var_dump, ça affiche Illuminate\Database\Eloquent\Collection
		return view('controleur', [
			'posts' => $posts
		]);
	}

	public function show($id=1) // la fonction show va prendre la valeur id envoyée depuis la route (web.php). Si on ne renseigne pas le id il prendra la valeur "1" par défaut (ne pas oublier de rajouter ? devant le id dans la route)
	{
		/*On va récupérer des info de chaque poste en fonction de l'id*/
		$post = Post::findorFail($id); //(find tout seul marche aussi mais ne gére pas l'erreur)on va chercher le post grace à son id dans la tabel Posts par l'intermédiaire du models Posts, si il ne trouve pas alors il renvois la page d'erreur 404

		/**** on peut chercher un post en fonction de son titre par exemple (pas de son id comme au dessus)***
		 $post = Post::where('title', '=', 'Sit pariatur laudantium ullam dolores.')->first(); le '=' n'est pas obligatoire
		 - get: pour tout recupérer, on se retrouve avec un array qui n'est pas exploitable 
		 - first: pour récupérer que le 1er (ou firstOrFail) et on a pas un array et donc exploitable
		 * */


		return view('page2', [ //on retourne à la page 2 la valeur de $post qui va contenir un post spécifique selon l'id
			'post' => $post 
		]);

		$tableau2 = [
			1 => "Mon titre n°1",
			2 => "Mon titre n°2"
		];

		$item = $tableau2[$id] ?? 'Pas de titre pour cet id'; //on va récupérer la valeur en fonction de ce qu'on met dans l'id (dans l'url exemple: /page2/1). ATTENTIOn le tableau2 n'a que deux items donc on peut mettre 1 ou 2 comme id
		//L’opérateur fusion null ?? ressemble dans sa syntaxe et dans son fonctionnement à l’opérateur ternaire: Cet opérateur utilise la syntaxe suivante : (test ?? code à renvoyer si le résultat du test est NULL)

		// return view('page2', [
		// 	'item' => $item
		// ]);
	}

	public function contact() // cette fonction n'a pas de paramétre et va juste retourner la vue contact
	{
		return view('contact');
	}

	public function accueil() 
	{
		return view('welcome');
	}

	/*Fonction de la création*/
	public function create() 
	{
		return view('form');
	}

	public function store(Request $request/*,$name*/) //on utilise l'objet Request de Laravel et on récupére les info dans $request
	{	//$name est un paramétre envoyé dans l'URL (route), on peut le récupérer avec : dd($name);
		//dd($request); // on voit qu'on obtient un super objet avec beaucoup d'info. dans request->parameters on à nos données envoyées en POST
		//dd($request->title); // avec ça on récupére le title comme si $request était un objet et title est un attribut (on peut faire comme ça aussi dd($request->input('title')); )

		/******* OBJET REQUEST**************************************************************************************************
		voir le Objet REQUEST.txt
		*************************************************************************************************************************/

		/****On va se créer un nouvel enregistrement****/
		/*
		$post = new Post(); // on créer un nouvel objet Post
		$post->title = $request->title; // on le rempli avec les info de $request
		$post->content = $request->content;
		$post->save(); //pour persister en base de données
		dd('post crée');
		*/

		/**** Validation du formulaire ****/
		$request->validate([
			//'title' => 'required|min:5|max:20|unique:posts', //obligatoir|minimum 5 caractéres|...|unique dans la table posts
	/* OU */  'title' => ['required', 'min:5', 'max:20', 'unique:posts', new Uppercase], /*utile pour les régle personalisée*/
			'content' => 'required'
		]);
		//Si les champs ne sont pas rempli on ne passe pas cette étape, mais on dois récupérer les erreurs pour les afficher, ça sera dans le fichier form.blade.php.

		/**** Autre façon de faire plus pratique ***/
		// ATTENTION: ne pas oublier de modifier le model Post pour autoriser l'accée au attributs
		 Post::create([
			'title' => $request->title,
			'content' => $request->content
		 ]);
		 dd('post crée');

		/**** Pour l'UPDATE ****/
		/*
		$post = Post::find(1); //on récupére le 1er enregistrement
		$post->update([
			'title'=> 'nouveau titre'
		])
		*/

		/**** Pour SUPPRIMER ****/
		/*
		$post = Post::find(12); //on récupére le 12éme enregistrement
		$post->delete();
		])
		*/
		
	}
}
