<?php

use Illuminate\Database\Seeder;

class GlobalvarsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vars = [
            [
                'id' => 0,
                'keyname' => 'loveseat',
                'value' => 1.1
            ]
        ];

        // Create seed (console: php artisan migrate:refresh --seed)
        foreach($vars as $var)
        {
            \App\GlobalVars::query()->insert($var);
        }
    }
}