<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Article;
use App\Models\Category;
use App\Models\Lang;
use App\Models\User;
use App\Models\Text;

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call('UserTableSeeder');
        $this->call('ArticlesSeeder');
        $this->call('CategoriesSeeder');
        $this->call('LangsSeeder');
        $this->call('UsersSeeder');
        $this->call('TextsSeeder');

    }

}

class ArticlesSeeder extends Seeder {

    public function run()
    {
        DB::table('Articles')->delete();


    }

}

class CategoriesSeeder extends Seeder {

    public function run()
    {
        DB::table('Categories')->delete();

        Category::create([
            'id' => "1",
            'name' => 'Головна',
            'link' => 'main',
            'fields' => '{"base": ["title", "description"],"attributes": {"Ціна": {"type": "input","lang_active": false,"active": true}},
            {"Специфікація": {"type": "textarea","lang_active": true,"active": true},"Кількість": {"type": "input","lang_active": false,"active": true}}}',
        ]);
        Category::create([
            'id' => "2",
            'name' => 'Візи',
            'link' => 'visas',
            'fields' => '
            {
                "base": ["title", "description"],
                "attributes": {
                    "price": {
                        "type": "input",
                        "lang_active": false
                    },
                    "specification": {
                        "type": "textarea",
                        "lang_active": true
                    }
                }
            }',
        ]);


       Category::create([
            'id' => "3",
            'name' => 'Поради',
            'link' => 'advices',
           'fields' => '
            {
                "base": ["title","short_description", "description"],
                "attributes": [{
                    "price": {
                        "type": "input",
                        "lang_active": true
                    }
                }, {
                    "specification": {
                        "type": "textearea",
                        "lang_active": true
                    }
                }]
            }',
       ]);



        /*Category::create([
            'id' => "4",
            'name' => 'Вакансії',
            'link' => 'works',
            'fields' => '["title","short_description","description","gallery","priority","active","price"]',
        ]);

        /* Category::create([
             'id' => "4",
             'name' => 'Події',
             'link' => 'events',
             'fields' => '["title","description","gallery","date","priority","active"]',
         ]);*/

       /*Category::create([
            'id' => "5",
            'name' => 'Галерея',
            'link' => 'gallery',
            'fields' => '["title","short_description","description","gallery","priority","active"]',
        ]);

       Category::create([
            'id' => "6",
            'name' => 'Слайдер',
            'link' => 'slider',
            'fields' => '["title","short_description","description","gallery","priority","active"]',
        ]);*/

        /*Category::create([
            'id' => "8",
            'name' => 'Коментарі',
            'link' => 'comments',
            'fields' => '["title","meta_title","meta_description","meta_keywords"]',
        ]);
        Category::create([
            'id' => "9",
            'name' => 'Резюме',
            'link' => 'resume',
            'fields' => '["title","meta_title","meta_description","meta_keywords"]',
        ]);*/
    }

}

class LangsSeeder extends Seeder {

    public function run()
    {
        DB::table('langs')->delete();

        Lang::create([
            'lang' => 'ua',
        ]);

        Lang::create([
            'lang' => 'ru',
        ]);

        /*Lang::create([
            'lang' => 'en',
        ]);*/

    }

}

class UsersSeeder extends Seeder {

    public function run()
    {
        DB::table('Users')->delete();

        User::create([
            'name' => 'admin',
            'email' => 'exampl@com.ua',
            'password' => '$2y$10$3pPgTtpNQRtvCXu4FwU61es3fbKaADLLX4EawHVbW9h2h4rQD535i',
        ]);

        User::create([
            'name' => 'root',
            'email' => 'webdesignstudio@gmail.com',
            'password' => '$2y$10$BdvnOe9NrHYCkipriMsBRuvfVrOGQI0oi7XzPHQSQ42pUpJGg4Q6y',
        ]);
    }

}
class TextsSeeder extends Seeder {

    public function run()
    {
        DB::table('Texts')->delete();

        Text::create([
            'page_id' => '0',
            'name' => "header.tel1",
            'type' => 'input',
            'title' => 'Контактний номер телефону 1',
            'description' => '+3809912345',
            'priority' => '3',
            'lang_active' => "0",
        ]);
        Text::create([
            'page_id' => '0',
            'name' => "header.tel2",
            'type' => 'input',
            'title' => 'Контактний номер телефону 2',
            'description' => '+3809854321',
            'priority' => '3',
            'lang_active' => "0",
        ]);

        Text::create([
            'page_id' => '0',
            'name' => "header.address",
            'type' => 'input',
            'title' => 'Адреса',
            'description' => 'м.Львів',
            'priority' => '2',
            'lang_active' => "1",
        ]);

        Text::create([
            'page_id' => '0',
            'name' => "header.mail",
            'type' => 'input',
            'title' => 'Пошта',
            'description' => 'exampl@gmail.com',
            'priority' => '1',
            'lang_active' => "0",
        ]);



    }

}


