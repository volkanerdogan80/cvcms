<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Test extends Migration
{
	public function up()
	{
		//
	}

	public function down()
	{
        $this->forge->dropTable('content_likes');
	}
}
