{{-- Ce fichier va être fixé sur toute les pages car il est appelé en include sur le fichier app.blade.php --}}
<ul class="nav justify-content-center">
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="{{ route('welcome') }}">Accueil</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="http://localhost/Formation%20ICS/16-%20Laravel/tutoYoutube/public/page2">Page 2</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('posts.create') }}">Création</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('contact') }}">Contact</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('controleur') }}">Controleur</a>
  </li>
</ul>
{{-- Dans les href nous avons mis les lien en dur, on peut cependant les dynamiser
      Il faut aller dans le fichier web.php (les routes) pour ajouter la fonction name pour chaque route et ensuite mettre ce name dans le href ici.
      "Pour lister toute les routes on peut s'aider de la ligne de commande en tapant : " php artisan route:list " --}}