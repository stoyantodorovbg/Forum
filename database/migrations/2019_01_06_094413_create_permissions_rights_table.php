<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsRightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions_rights', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('permission_id')->unsigned();
            $table->foreign('permission_id')
                ->references('id')
                ->on('permissions');
            $table->integer('right_id')->unsigned();
            $table->foreign('right_id')
                ->references('id')
                ->on('rights');
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
        Schema::dropIfExists('permissions_rights');
    }
}
