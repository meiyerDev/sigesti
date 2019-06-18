<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('serial',255);
            $table->string('model',255);
            $table->string('brand',255);
            $table->enum('type',['Laptop','Impresora','Cartucho','Monitor','Cpu','Monitor-Desktop','Cpu-Desktop','Otro']);
            $table->string('name_otro',255)->nullable();
            $table->unsignedInteger('department_id')->nullable();
            $table->timestamps();
        
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
