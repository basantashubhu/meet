<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();
        Schema::create('lsv_rooms', function (Blueprint $table) {
            $table->increments('room_id');
            $table->string('agent')->nullable();
            $table->string('visitor')->nullable();
            $table->string('agenturl')->nullable();
            $table->string('visitorurl')->nullable();
            $table->string('password')->nullable();
            $table->string('roomId')->nullable();
            $table->string('datetime')->nullable();
            $table->string('duration')->nullable();
            $table->string('shortagenturl')->nullable();
            $table->string('shortvisitorurl')->nullable();
            $table->string('agent_id')->nullable();
            $table->boolean('is_active')->default(1);
            $table->text('agenturl_broadcast')->nullable();
            $table->text('visitorurl_broadcast')->nullable();
            $table->text('shortagenturl_broadcast')->nullable();
            $table->text('shortvisitorurl_broadcast')->nullable();
            $table->text('title')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lsv_rooms');
    }
}
