<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('reg_no')->nullable();
            $table->string('image')->nullable();


            $table->string('dept_id')->nullable();
            $table->string('hostel_id')->nullable();
            $table->string('program_id')->nullable();
            $table->string('user_id')->nullable();

            $table->string('batch_id')->nullable();

            $table->string('mobile_phone')->nullable();
            $table->enum('gender', array('Male', 'Female'))->nullable();
            $table->string('nationality')->nullable();
            
            $table->string('citizenship_no')->nullable();
            $table->string('citizenship_issue_place')->nullable();
            $table->date('citizenship_issue_date')->nullable();

            $table->string('guardian_name')->nullable();
            $table->string('guardian_relation')->nullable();
            $table->string('guardian_occupation')->nullable();
            $table->string('guardian_contact')->nullable();

            $table->string('email')->nullable();
            $table->date('date_of_birth')->nullable();
            
            $table->softDeletes();

            $table->index(['deleted_at']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student');
    }
}
