<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('emp_id');
			$table->integer('goal_id');
			$table->integer('lm_rate');
			$table->integer('lm_id');
			$table->string('lm_comment',6000);
			$table->integer('admin_id');
			$table->integer('admin_rate');
			$table->string('admin_comment');
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
        Schema::dropIfExists('ratings');
    }
}
