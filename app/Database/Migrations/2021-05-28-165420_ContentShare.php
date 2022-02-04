<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ContentShare extends Migration
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
            'social' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'default' => 'twitter',
            ],
            'status' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
            ],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('content_share');
    }

    //--------------------------------------------------------------------

    public function down()
    {
        //
    }
}
