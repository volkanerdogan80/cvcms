<?php


namespace App\Database\Seeds\Demo;

use App\Models\GroupModel;
use \CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        helper('text');
        $faker = \Faker\Factory::create('tr_TR');

        $groupModel = new GroupModel();
        $group = $groupModel->where('slug', DEFAULT_REGISTER_USER)->first();

        for ($i=0; $i<10; $i++){

            $phone = str_replace(' ', '', $faker->phoneNumber);
            $phone = str_replace('(', '', $phone);
            $phone = str_replace(')', '', $phone);

            $data = [
                'group_id' => $group->id,
                'first_name' => $faker->firstName,
                'sur_name' => $faker->lastName,
                'email' => $faker->email,
                'phone' => $phone,
                'api_key' => implode('.', str_split(md5(uniqid()), rand(4,28))),
                'identification_number' => random_string('numeric', 11),
                'password' => password_hash('123', PASSWORD_DEFAULT),
                'verify_key' => random_string('alpha', 64),
                'verify_code' => random_int(100000, 999999),
                'bio' => 'Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.',
                'status' => STATUS_ACTIVE
            ];

            $this->db->table('users')->insert($data);
        }
    }
}