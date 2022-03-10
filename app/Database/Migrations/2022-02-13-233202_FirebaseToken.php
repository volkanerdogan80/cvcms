<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FirebaseToken extends Migration
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
            'token' => [
                'type' => 'text',
                'null' => false,
            ],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('firebase_token');
    }

    public function down()
    {
        $this->forge->dropTable('firebase_token');
    }
}
