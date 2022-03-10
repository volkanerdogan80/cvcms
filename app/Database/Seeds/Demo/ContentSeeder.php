<?php


namespace App\Database\Seeds\Demo;


use CodeIgniter\Database\Seeder;

class ContentSeeder extends Seeder
{
    public function run()
    {
        helper('text');
        $faker = \Faker\Factory::create('tr_TR');

        for ($i=0; $i<5; $i++){
            $data = [
                'module' => 'blog',
                'user_id' => 1,
                'slug ' => $faker->slug,
                'title' => json_encode([
                    'tr' => $faker->sentence(3, true),
                    'en' => $faker->sentence(3, true)
                ], JSON_UNESCAPED_UNICODE),
                'description' => json_encode([
                    'tr' => $faker->paragraph(4, true),
                    'en' => $faker->paragraph(4, true)
                ], JSON_UNESCAPED_UNICODE),
                'content' => json_encode([
                    'tr' => implode(' ', $faker->paragraphs(4, false)),
                    'en' => implode(' ', $faker->paragraphs(4, false))
                ], JSON_UNESCAPED_UNICODE),
                'keywords' => json_encode([
                    'tr' => implode(',', $faker->words(5, false)),
                    'en' => implode(',', $faker->words(5, false)),
                ], JSON_UNESCAPED_UNICODE),
                'views' => rand(0, 250),
                'status' => STATUS_ACTIVE,
            ];

            $this->db->table('contents')->insert($data);

            $this->db->table('content_categories')->insert([
                'content_id' => $this->db->insertID(),
                'category_id' => $i+1
            ]);

        }
    }
}
