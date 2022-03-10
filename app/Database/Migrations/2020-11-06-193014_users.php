<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
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
            'group_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false
            ],
            'first_name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'sur_name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
                'unique' => true
            ],
            'phone' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
                'null' => true,
                'unique' => false
            ],
            'identification_number' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
                'unique' => false
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false
            ],
            'verify_key' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false
            ],
            'verify_code' => [
                'type' => 'INT',
                'constraint' => 6,
                'null' => true
            ],
            'api_key' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false
            ],
            'bio' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['ACTIVE','PASSIVE','PENDING'],
                'default' => 'PENDING'
            ],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
