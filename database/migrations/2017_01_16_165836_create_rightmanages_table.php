<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRightmanagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rightmanagements', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('user_id');
			$table->string('attendance');
			$table->string('goal');
			$table->string('settings');
			$table->string('record');
			$table->string('payroll');
			$table->string('talent');
			$table->string('execview');
			$table->string('talentmanage');
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
        Schema::dropIfExists('rightmanagements');
    }
}
