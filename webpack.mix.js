const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */
/*
Le code en bas correspond à une façon de compiler JS
*/

mix.js('resources/js/app.js', 'public/js') //cette fonction permet d'aller récupérer dans resources/js/app.js tout notre js et de le compiler dans un fichier js en app.js qui se trouverais dans public/js (qui n'existe pas mais il le créera au moment où on fera notre compilation): cette méthode est chainé avec la méthode en bas postCss 
    .postCss('resources/css/app.css', 'public/css', [ //cette fonction permet de compiler le fichier qui se trouve dans 'resources/css/app.css' dans 'public/css' 
        require('tailwindcss'), // c'est un code correspondant au tailwindcss
    ]);
// lorsqu'on va dans le dossier resources on à bien un dossier css (vide) et un dossier js (avec require)
