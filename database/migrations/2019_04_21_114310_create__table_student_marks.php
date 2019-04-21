<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableStudentMarks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('student_marks')) {
            Schema::create('student_marks', function (Blueprint $table) {
                
                $table->increments('id');
                
                $table->string('student_id')->nullable();

                $table->text('course_id')->nullable();

                $table->text('marks')->nullable();
                $table->text('attendance')->nullable();
                
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
        Schema::dropIfExists('student_marks');
        //
    }
}
