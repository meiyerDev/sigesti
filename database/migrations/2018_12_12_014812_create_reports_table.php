<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('article_id');
            $table->enum('maintenance',['Preventivo', 'Correctivo'])->nullable();
            $table->enum('request',['Correo', 'Vocal', 'Telefonica', 'Escrita']);
            $table->enum('internet', ['Instalacion','Configuracion','Monitoreo'])->nullable();
            $table->enum('users', ['Instalacion','Configuracion','Monitoreo'])->nullable();
            $table->enum('cartucho',['Recarga','Mantenimiento'])->nullable();
            $table->text('description')->nullable();
            $table->unsignedInteger('expert_id')->nullable();
            $table->timestamps();

            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
            $table->foreign('expert_id')->references('id')->on('experts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports');
    }
}
