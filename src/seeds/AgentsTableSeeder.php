<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = md5('password@1');
        DB::insert("INSERT INTO `lsv_agents` VALUES ('1', 'admin', 'first', 'last', 'admin', '$password', 'admin@admin.com', '1', '', '');");
    }
}
