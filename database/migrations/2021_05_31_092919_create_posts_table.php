<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) { // la classe Blueprint va gérer les types (string, text, boolen ...) de colonnes qu'on peut créer
            $table->id(); // la table aura un id crée grace à la fonction id
            //On va pouvoir ici rajouter les colonnes qu'on veut créer dans notre table Post
            $table->string('title');
            $table->mediumText('content');

            $table->timestamps(); // la fonction timestamps va créer 2 colonnes : created_at et updated_at

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
