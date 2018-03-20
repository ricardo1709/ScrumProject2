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
                'id' => 1,
                'keyname' => 'loveseat',
                'value' => 1.1
            ],
            
            [
                'id' => 2,
                'keyname' => 'seat',
                'value' => 8.0
            ]
        ];

        // Create seed (console: php artisan migrate:refresh --seed)
        foreach($vars as $var)
        {
            \App\GlobalVars::query()->insert($var);
        }
    }
}
