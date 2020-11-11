<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();
        Schema::create('lsv_users', function (Blueprint $table) {
            $table->increments('user_id');
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->string('name')->nullable();
            $table->string('roomId')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('token')->nullable();
            $table->boolean('is_blocked')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lsv_users');
    }
}
