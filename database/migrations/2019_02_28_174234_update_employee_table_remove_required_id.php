<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateEmployeeTableRemoveRequiredId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employee', function (Blueprint $table) {
            $table->unsignedInteger('dept_id')->nullable()->change();
            $table->unsignedInteger('job_id')->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedInteger('job_id')->nullable(false)->change();
            $table->unsignedInteger('dept_id')->nullable(false)->change();
        });
    }
}
