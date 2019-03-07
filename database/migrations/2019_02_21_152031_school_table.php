<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SchoolTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school',function (Blueprint $table){

            $table->increments('id');
            $table->String('name');
            $table->String('address');
            $table->String('phone');
            $table->String('email');
            $table->String('contact_person');
            $table->String('contact_person_phone');
            $table->integer('status');
            $table->String('notes');
            
            /**
             * Foreignkeys section
             */
            
            
            $table->timestamps();
            
            
            $table->softDeletes();
            
            // type your addition here
    
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('school');
        //
    }
}
