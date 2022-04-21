<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserMarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_marks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student');
            $table->foreign('student')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('math')->length(3)->default(null);
            $table->integer('science')->length(3)->default(null);
            $table->integer('history')->length(3)->default(null);
            $table->unsignedBigInteger('term');
            $table->foreign('term')->references('id')->on('terms')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_marks');
    }
}
