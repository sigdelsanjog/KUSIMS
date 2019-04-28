<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateMarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('student_marks', function($table) {
            $table->text('program_id')->nullable();
            $table->text('batch_id')->nullable();
            $table->text('dept_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('student_marks', function($table) {
            $table->dropColumn('program_id');
            $table->dropColumn('batch_id');
            $table->dropColumn('dept_id');
        });
    }
}
