<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpDependantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emp_dependants', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->date('dob');
            $table->string('email');
            $table->string('phone_num',14);
            $table->integer('emp_id');
			
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
        Schema::dropIfExists('emp_dependants');
    }
}
