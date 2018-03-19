<?php

use Illuminate\Database\Seeder;
use App\Movie;
use App\Room;
use App\Seat;

class general extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // users
        $users = [
            [
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => 'admin123',
                'role' => '3'
            ],
            [
                'name' => 'owner',
                'email' => 'owner@admin.com',
                'password' => 'admin123',
                'role' => '2'
            ],
            [
                'name' => 'medewerker',
                'email' => 'medewerker@admin.com',
                'password' => 'admin123',
                'role' => '1'
            ],
            [
                'name' => 'custom',
                'email' => 'custom@admin.com',
                'password' => 'admin123'
            ]
        ];
        
        foreach ($users as $user)
        {
            \App\User::create($user);
        }
        // room
        
        $rooms = [
            [
                'seats' => '30',
                'loverSeats' => '5',
                'loverRow' => '3',
                'rows' => '6'
            ],
            [
                'seats' => '30',
                'loverSeats' => '5',
                'loverRow' => '3',
                'rows' => '6'
            ],
            [
                'seats' => '30',
                'loverSeats' => '5',
                'loverRow' => '3',
                'rows' => '6'
            ]
        ];
        
        foreach($rooms as $room)
        {
            $id = Room::query()->insertGetId($room);
            
            for ($i=0;$i<$room['seats'];$i++)
               Seat::query()->insert(['roomId' => $id, 'isGereserveerd' => 0]);
        }
        
    }
}