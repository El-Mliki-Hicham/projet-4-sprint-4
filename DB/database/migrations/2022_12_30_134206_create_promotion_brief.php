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
        Schema::create('Promotion_preparation_brief', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("Preparation_brief_id")->nullable();
            $table->foreign("Preparation_brief_id")
            ->references("id")
            ->on('Preparation_brief')
            ->onDelete('cascade');

            $table->unsignedInteger("Promotion_id")->nullable();
            $table->foreign("Promotion_id")
            ->references("id")
            ->on('Promotion')
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
        Schema::dropIfExists('students');
    }
};
