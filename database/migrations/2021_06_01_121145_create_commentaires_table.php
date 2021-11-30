<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commentaires', function (Blueprint $table) {
            $table->id();
            $table->mediumText('content');
            $table->timestamps();

            /*
            Premiére méthode
            $table->unsignedBigInteger('post_id'); //pour definir une clé etrangére
            $table->foreign('post_id')->references('id')->on('post');
            */

            /*Deuxiéme méthode*/
            $table->foreignId('post_id')->constrained('posts'); //ici pas la peine de rappeler sur qui on fait reference car il voit qu'on a mis post_id donc il comprend que c'est sur l'id ded la table post
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commentaires');
    }
}
