<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLsvAgentsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		$this->down();
		Schema::create('lsv_agents', function (Blueprint $table) {
			$table->increments('agent_id');
			$table->string('tenant')->nullable();
			$table->string('first_name')->nullable();
			$table->string('last_name')->nullable();
			$table->string('username')->nullable();
			$table->string('password')->nullable();
			$table->string('email')->nullable();
			$table->boolean('is_master')->default(0);
			$table->string('roomId')->nullable();
			$table->string('token')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('lsv_agents');
	}
}
