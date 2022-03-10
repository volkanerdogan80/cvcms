<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ContentFavorites extends Migration
{
    public function up()
    {
        $this->db->disableForeignKeyChecks();
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
                'unsigned' => true,
                'null' => false,
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
            ],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('content_id', 'contents', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('content_favorites');
        $this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->forge->dropTable('content_favorites');
    }
}
