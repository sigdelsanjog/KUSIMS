<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusNoticeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bus_notice', function (Blueprint $table) {
            $table->increments('id');
            $table->string('date')->nullable();
            $table->string('noticetitle')->nullable();
            $table->string('filename')->nullable();
            $table->string('mime')->nullable();
            $table->string('original_filename')->nullable();
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
        Schema::dropIfExists('bus_notice');
    }
}
