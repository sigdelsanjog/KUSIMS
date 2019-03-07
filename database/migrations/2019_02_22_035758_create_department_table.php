<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('department', function (Blueprint $table) {
            $table->increments('id');
            
            $table->string('address')->nullable();
            $table->integer('block')->nullable();
            
            $table->integer('school_id');
            
            $table->string('contact_person')->nullable();
            
            $table->string('notes')->nullable();
            
            $table->string('phone')->nullable();
            
            $table->string('email')->nullable();
            
            $table->String('name');
            
            $table->integer('status')->nullable();

            $table->timestamps();
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
        Schema::dropIfExists('department');
    }
}
