<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('observation',255)->nullable();
            $table->unsignedInteger('responsable_id')->nullable();
            $table->unsignedInteger('expert_id')->nullable();
            $table->unsignedInteger('article_id');

            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
            $table->foreign('expert_id')->references('id')->on('experts')->onDelete('set null');
            $table->foreign('responsable_id')->references('id')->on('responsables')->onDelete('cascade');

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requests');
    }
}
