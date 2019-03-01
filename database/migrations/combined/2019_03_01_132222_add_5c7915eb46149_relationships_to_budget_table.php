<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c7915eb46149RelationshipsToBudgetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('budgets', function(Blueprint $table) {
            if (!Schema::hasColumn('budgets', 'project_id')) {
                $table->integer('project_id')->unsigned()->nullable();
                $table->foreign('project_id', '272448_5c7913942b0a7')->references('id')->on('projects')->onDelete('cascade');
                }
                if (!Schema::hasColumn('budgets', 'category_id')) {
                $table->integer('category_id')->unsigned()->nullable();
                $table->foreign('category_id', '272448_5c7913944123f')->references('id')->on('categories')->onDelete('cascade');
                }
                if (!Schema::hasColumn('budgets', 'year_id')) {
                $table->integer('year_id')->unsigned()->nullable();
                $table->foreign('year_id', '272448_5c7913945923a')->references('id')->on('years')->onDelete('cascade');
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
            if(Schema::hasColumn('budgets', 'project_id')) {
                $table->dropForeign('272448_5c7913942b0a7');
                $table->dropIndex('272448_5c7913942b0a7');
                $table->dropColumn('project_id');
            }
            if(Schema::hasColumn('budgets', 'category_id')) {
                $table->dropForeign('272448_5c7913944123f');
                $table->dropIndex('272448_5c7913944123f');
                $table->dropColumn('category_id');
            }
            if(Schema::hasColumn('budgets', 'year_id')) {
                $table->dropForeign('272448_5c7913945923a');
                $table->dropIndex('272448_5c7913945923a');
                $table->dropColumn('year_id');
            }
            
        });
    }
}
