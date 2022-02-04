<?php


namespace App\Database\Seeds;

use App\Models\UserRoleModel;
use \CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        helper('text');

        $groupModel = new UserRoleModel();
        $group = $groupModel->where('slug', DEFAULT_ADMIN_GROUP)->first();

        $data = [
            'group_id' => $group->id,
            'first_name' => 'Volkan',
            'sur_name' => 'Erdoğan',
            'email' => 'admin@admin.com',
            'password' => password_hash('123', PASSWORD_DEFAULT),
            'verify_key' => random_string('alpha', 64),
            'verify_code' => random_int(100000, 999999),
            'bio' => 'Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.',
            'status' => STATUS_ACTIVE
        ];

        $this->db->table('users')->insert($data);
    }
}