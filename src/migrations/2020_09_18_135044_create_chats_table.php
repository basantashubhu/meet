<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();
        Schema::create('lsv_chats', function (Blueprint $table) {
            $table->increments('chat_id');
            $table->mediumText('message')->nullable();
            $table->string('system')->default('');
            $table->string('participants')->nullable();
            $table->string('from')->nullable();
            $table->string('agent_id')->nullable();
            $table->dateTime('date_created')->nullable();
            $table->string('avatar')->nullable();
            $table->string('room_id')->nullable();
            $table->string('agent')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lsv_chats');
    }
}
