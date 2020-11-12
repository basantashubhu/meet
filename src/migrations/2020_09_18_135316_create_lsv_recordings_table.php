<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLsvRecordingsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		$this->down();
		Schema::create('lsv_recordings', function (Blueprint $table) {
			$table->increments('recording_id');
			$table->string('filename');
			$table->string('room_id');
			$table->string('agent_id')->nullable();
			$table->dateTime('date_created')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('lsv_recordings');
	}
}
