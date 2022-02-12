<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ContentRating extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'content_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
            ],
            'vote' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => false,
            ],
            'remote_addr' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('content_rating');
    }

    public function down()
    {
        //
    }
}
