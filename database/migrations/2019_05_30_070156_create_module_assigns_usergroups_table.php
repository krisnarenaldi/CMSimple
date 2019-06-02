<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModuleAssignsUsergroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module_assigns_usergroups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('module_id')->unsigned();
            $table->bigInteger('usergroup_id')->unsigned();
            $table->string('created_by',80);
            $table->string('modified_by',80);
            $table->timestamps();

            $table->foreign('module_id')->references('id')
                  ->on('modules')
                  ->onDelete('cascade');

            $table->foreign('usergroup_id')->references('id')
                  ->on('usergroups')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('module_assigns_usergroups');
    }
}
