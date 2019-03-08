<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableStudentQualification extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        if(! Schema::hasTable('student_qualification')) {
            Schema::create('student_qualification', function (Blueprint $table) {
               
                $table->increments('id');
                $table->integer('student_id')->nullable();

                $table->string('board')->nullable();
                $table->string('year_of_completion')->nullable();
                $table->string('aggregate_percent')->nullable();
                $table->string('symbol_no')->nullable();
                $table->string('division')->nullable();

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
        Schema::dropIfExists('student_qualification');
    }
}
