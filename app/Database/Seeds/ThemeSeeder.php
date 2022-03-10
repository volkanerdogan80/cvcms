<?php


namespace App\Database\Seeds;

use \CodeIgniter\Database\Seeder;

class ThemeSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('themes')->insert([
            'folder' => 'default',
            'name' => 'Default Theme',
            'author' => 'Volkan Erdoğan',
            'web' => 'https://cvmuhendislik.com',
            'email' => 'volkanerdogan80@gmail.com',
            'status' => STATUS_ACTIVE,
            'settings' => json_encode(['default' => 'cve'], JSON_UNESCAPED_UNICODE)
        ]);
    }
}