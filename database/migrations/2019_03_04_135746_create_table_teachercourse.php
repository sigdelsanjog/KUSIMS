<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTeachercourse extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        if(! Schema::hasTable('teacher_course')) {
            Schema::create('teacher_course', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('teacher_id')->nullable();
                $table->integer('batch_id')->nullable();
                $table->integer('program_id')->nullable();
                $table->integer('dept_id')->nullable();
                $table->integer('course_id')->nullable();
                
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
        Schema::dropIfExists('teacher_course');
    }
}
