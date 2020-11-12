<?php

namespace SysthaTech\Meeting\Commands;

use Illuminate\Console\Command;
use ZipArchive;

class InstallCommand extends Command {
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'meeting:install';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Install livesmart library';

	protected $zipErrors = [
		ZipArchive::ER_EXISTS => "File already exists.",
		ZipArchive::ER_INCONS => "Zip archive inconsistent.",
		ZipArchive::ER_INVAL => "Invalid argument.",
		ZipArchive::ER_MEMORY => "Malloc failure.",
		ZipArchive::ER_NOENT => "No such file.",
		ZipArchive::ER_NOZIP => "Not a zip archive.",
		ZipArchive::ER_OPEN => "Can't open file.",
		ZipArchive::ER_READ => "Read error.",
		ZipArchive::ER_SEEK => "Seek error.",
	];

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle() {
		$this->warn('This may take some time. Please wait for a while...');
		system('rm -rf ' . public_path('meeting'));
		$zipHandler = new ZipArchive();
		if (($code = $zipHandler->open($this->realPath())) === true) {
			// $zipHandler->addFile();
			$zipHandler->extractTo(public_path('meeting'));
			$zipHandler->close();
			$this->replaceURI();
			$this->info('Installation completed.');
			$this->info("\n\nRun following commands to finish migration and seeding:");
			$this->info("\nphp artisan vendor:publish   // Select SysthaTech\Meeting\MeetingServiceProvider");
			$this->info("composer dumpautoload");
			$this->info("php artisan migrate");
			$this->info("php artisan db:seed --class='AgentsTableSeeder'");
		} else {
			$err = isset($this->zipErrors[$code]) ? $this->zipErrors[$code] : '';
			$this->error('Unable to install the package!' . $err);
		}
	}

	public function realPath() {
		defined('DS') OR define('DS', DIRECTORY_SEPARATOR);

		$path = explode(DS, __DIR__);
		array_pop($path);
		return implode(DS, $path) . DS . 'zips' . DS . 'assets.zip';
	}

	public function replaceURI() {
		$files = [
			public_path('meeting/client.html'),
			public_path('meeting/agent.html'),
		];

		foreach ($files as $file) {
			$content = file_get_contents($file);
			$updatedContent = preg_replace('/YOUR_DOMAIN/', rtrim(url('meeting'), '/'), $content);
			file_put_contents($file, $updatedContent);
		}
	}
}
