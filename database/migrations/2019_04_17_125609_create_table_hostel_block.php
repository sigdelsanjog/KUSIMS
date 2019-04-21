<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableHostelBlock extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('hostel_block')) {
            Schema::create('hostel_block', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->nullable();
                $table->string('location')->nullable();
                $table->string('incharge')->nullable();
                $table->string('contact')->nullable();
                
                $table->timestamps();
                $table->softDeletes();

                $table->index(['deleted_at']);
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
        //
        Schema::dropIfExists('hostel_block');
    }
}
