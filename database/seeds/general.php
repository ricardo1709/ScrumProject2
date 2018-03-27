<?php

use Illuminate\Database\Seeder;
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
        // password is for all users secret
        $users = [
            [
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',
                'role' => '3',
                'remember_token' => str_random(10)
                
            ],
            [
                'name' => 'owner',
                'email' => 'owner@admin.com',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',
                'role' => '2',
                'remember_token' => str_random(10)
            ],
            [
                'name' => 'medewerker',
                'email' => 'medewerker@admin.com',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',
                'role' => '1',
                'remember_token' => str_random(10)
            ],
            [
                'name' => 'customer',
                'email' => 'customer@admin.com',
                'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',
                'remember_token' => str_random(10)
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
                'loverSeats' => '6',
                'loverRow' => '3',
                'rows' => '6'
            ],
            [
                'seats' => '30',
                'loverSeats' => '6',
                'loverRow' => '3',
                'rows' => '6'
            ],
            [
                'seats' => '30',
                'loverSeats' => '6',
                'loverRow' => '3',
                'rows' => '6'
            ]
        ];
        
        foreach($rooms as $room)
        {
            $id = Room::query()->insertGetId($room);
            
            for ($i=0;$i<$room['seats'];$i++)
               Seat::query()->insert(['roomId' => $id, 'isGereserveerd' => 0]);
            for ($i=0;$i<$room['loverSeats'];$i++)
                Seat::query()->insert(['roomId' => $id, 'isGereserveerd' => 0, 'isLoveseat' => 1]);
        }
        
    }
}
