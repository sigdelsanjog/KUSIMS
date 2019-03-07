<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableStudentdocument extends Migration
{
    public function up()
    {
        //
        if(! Schema::hasTable('student_document')) {
            Schema::create('student_document', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('student_id')->nullable();
                $table->text('remarks')->nullable();
                $table->text('file_name')->nullable();
                $table->text('doc_type_id')->nullable();
                $table->text('status')->nullable();
                
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
        Schema::dropIfExists('student_document');
    }
}
