<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLsvDrawingsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		$this->down();
		Schema::create('lsv_drawings', function (Blueprint $table) {
			$table->increments('drawing_id');
			$table->text('drawing')->nullable();
			$table->text('room_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('lsv_drawings');
	}
}
