<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpPastEmpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emp_past_emps', function (Blueprint $table) {
            $table->increments('id');
            $table->string('organization');
            $table->string('role');
            $table->integer('emp_id');
            $table->date('from');
            $table->date('to');
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
        Schema::dropIfExists('emp_past_emps');
    }
}
