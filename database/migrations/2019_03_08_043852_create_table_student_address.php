<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableStudentAddress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        if(! Schema::hasTable('student_address')) {
            Schema::create('student_address', function (Blueprint $table) {
               
                $table->increments('id');
                $table->integer('student_id')->nullable();

                $table->string('primary_country')->nullable();
                $table->string('primary_state')->nullable();
                $table->string('primary_district')->nullable();
                $table->string('primary_city')->nullable();
                $table->string('primary_street')->nullable();
                $table->string('ward_no')->nullable();
                $table->string('house_no')->nullable();
                $table->string('primary_postal_address')->nullable();

                $table->string('temp_country')->nullable();
                $table->string('temp_state')->nullable();
                $table->string('temp_district')->nullable();
                $table->string('temp_city')->nullable();
                $table->string('temp_street')->nullable();
                $table->string('temp_ward_no')->nullable();
                $table->string('temp_house_no')->nullable();
                $table->string('temp_postal_address')->nullable();

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
        
        Schema::dropIfExists('student_address');
    }
}
