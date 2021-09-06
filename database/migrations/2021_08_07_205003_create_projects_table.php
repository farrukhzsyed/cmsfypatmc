<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('serial');
            $table->text('description');
            $table->text('requirement');
            $table->string('projectFile')->nullable();
            $table->foreignId('ownBy')->nullable();
            $table->integer('percentageComplete')->unsigned()->default(0)->max(100);
            $table->date('startDate')->nullable();
            $table->date('completeDate')->nullable();
            $table->date('deliveryDate')->nullable();
            $table->boolean('isDelivered')->boolean()->default(0);
            $table->text('feedback')->nullable();
            $table->timestamps();
            $table->foreign('ownBy')->references('id')->on('clients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
