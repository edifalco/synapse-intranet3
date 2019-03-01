<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5c7913a842ab2MediumProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('medium_project')) {
            Schema::create('medium_project', function (Blueprint $table) {
                $table->integer('medium_id')->unsigned()->nullable();
                $table->foreign('medium_id', 'fk_p_272453_272456_projec_5c7913a842c28')->references('id')->on('media')->onDelete('cascade');
                $table->integer('project_id')->unsigned()->nullable();
                $table->foreign('project_id', 'fk_p_272456_272453_medium_5c7913a842d03')->references('id')->on('projects')->onDelete('cascade');
                
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medium_project');
    }
}