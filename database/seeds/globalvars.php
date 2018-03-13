<?php

use Illuminate\Database\Seeder;

class globalvars extends Seeder
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
    }
}
