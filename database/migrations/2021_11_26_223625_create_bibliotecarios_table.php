<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBibliotecariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bibliotecarios', function (Blueprint $table) {
            $table->id();
            $table->string('matricula')->unique()->nullable();
            $table->timestamps();
            $table->string('crb')->unique()->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('biblioteca_id')->nullable();
            $table->foreign('biblioteca_id')->references('id')->on('bibliotecas');
            $table->boolean('nbid')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bibliotecarios');
    }
}
