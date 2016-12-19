<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->integer('id_user');
            $table->foreign('id_user')->references('id')->on('users');
            $table->string('author')->nullable();
            $table->string('path')->unique();
            $table->string('tags')->nullable();
            $table->string('tittle')->nullable();
            $table->string('photoname');
            $table->integer('likes')->default(0);
            $table->string('description')->nullable();
            $table->string('mode')->default('public');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('photos');
    }
}
