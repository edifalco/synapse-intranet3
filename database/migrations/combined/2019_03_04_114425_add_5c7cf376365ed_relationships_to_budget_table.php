<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c7cf376365edRelationshipsToBudgetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('budgets', function(Blueprint $table) {
            if (!Schema::hasColumn('budgets', 'projects_id')) {
                $table->integer('projects_id')->unsigned()->nullable();
                $table->foreign('projects_id', '273395_5c7ce74ca77f5')->references('id')->on('projects')->onDelete('cascade');
                }
                if (!Schema::hasColumn('budgets', 'category_id')) {
                $table->integer('category_id')->unsigned()->nullable();
                $table->foreign('category_id', '273395_5c7ce74cc1b85')->references('id')->on('categories')->onDelete('cascade');
                }
                if (!Schema::hasColumn('budgets', 'year_id')) {
                $table->integer('year_id')->unsigned()->nullable();
                $table->foreign('year_id', '273395_5c7ce74cdcf45')->references('id')->on('years')->onDelete('cascade');
                }
                
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('budgets', function(Blueprint $table) {
            if(Schema::hasColumn('budgets', 'projects_id')) {
                $table->dropForeign('273395_5c7ce74ca77f5');
                $table->dropIndex('273395_5c7ce74ca77f5');
                $table->dropColumn('projects_id');
            }
            if(Schema::hasColumn('budgets', 'category_id')) {
                $table->dropForeign('273395_5c7ce74cc1b85');
                $table->dropIndex('273395_5c7ce74cc1b85');
                $table->dropColumn('category_id');
            }
            if(Schema::hasColumn('budgets', 'year_id')) {
                $table->dropForeign('273395_5c7ce74cdcf45');
                $table->dropIndex('273395_5c7ce74cdcf45');
                $table->dropColumn('year_id');
            }
            
        });
    }
}
