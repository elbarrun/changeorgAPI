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
        Schema::create('peticiones', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 255);
            $table->text('descripcion')->nullable();
            $table->text('destinatario')->nullable();
            $table->integer('firmantes')->nullable();
            $table->enum('estado', ['aceptada', 'pendiente'])->nullable();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('categoria_id')->nullable();
            $table->string('file')-> nullable();
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
        Schema::dropIfExists('peticiones');
    }
};
