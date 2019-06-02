<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsergroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usergroups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_group',100)->default('kosong');
            $table->char('can_create',1)->default('0');
            $table->char('can_update',1)->default('0');
            $table->char('can_delete',1)->default('0');
            $table->char('can_publish',1)->default('0');
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
        Schema::dropIfExists('usergroups');
    }
}
