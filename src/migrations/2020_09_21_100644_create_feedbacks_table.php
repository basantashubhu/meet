<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedbacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();
        Schema::create('lsv_feedbacks', function (Blueprint $table) {
            $table->increments('feedback_id');
            $table->boolean('rate')->default(0);
            $table->string('text')->nullable();
            $table->string('user_id')->nullable();
            $table->string('session_id')->nullable();
            $table->string('room_id');
            $table->dateTime('date_added')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lsv_feedbacks');
    }
}
