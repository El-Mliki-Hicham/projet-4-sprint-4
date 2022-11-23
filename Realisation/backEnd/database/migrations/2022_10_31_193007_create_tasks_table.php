<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string("Nom_de_la_tache")->nullable();
            $table->timestamp("Debut_de_la_tache")->nullable();
            $table->timestamp("Fin_de_la_tache")->nullable();
            $table->string("Description")->nullable();
            $table->unsignedInteger("briefs_id");
            $table->foreign("briefs_id")
            ->references("id")
            ->on('briefs')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
};
