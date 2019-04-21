<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableHostelBook extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('hostel_book')) {
            Schema::create('hostel_book', function (Blueprint $table) {
                
                $table->increments('id');
                
                $table->string('room_id')->nullable();
                $table->string('student_id')->nullable();

                $table->text('status')->nullable();

                $table->text('remarks')->nullable();
                
                $table->date('joined_date')->nullable();
                $table->date('left_date')->nullable();

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
        Schema::dropIfExists('hostel_book');
    }
}
