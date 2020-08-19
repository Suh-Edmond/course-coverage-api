<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseDelegatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_delegates', function (Blueprint $table) {
            $table->id();
            $table->string('access_id');
            $table->string('user_name', 30);
            $table->string('matricule_number');
            $table->string('email', 45);
            $table->string('telephone');
            $table->string('password');
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
        Schema::dropIfExists('course_delegates');
    }
}
