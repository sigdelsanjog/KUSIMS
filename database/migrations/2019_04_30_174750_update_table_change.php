<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTableChange extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('course', function (Blueprint $table) {
            $table->string('credit');
            $table->unique('code');
        });     

        Schema::table('notice', function ($table) {
            $table->longText('description')->change();;
        });

        Schema::table('hostel_book', function ($table) {
            $table->mediumText('remarks')->nullable()->change();
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('course', function (Blueprint $table) {
            $table->dropColumn('credit');
            $table->dropUnique('code');
        });
        
        Schema::table('hostel_book', function ($table) {
            $table->text('remarks')->change();
        });
        
        Schema::table('notice', function ($table) {
            $table->text('description')->change();;
        });
        //
    }
}
