<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'dobrosite',
            'email' => 'dobrosite@example.com',
            'password' => bcrypt('1871881298747bigMixPaY$Clt'),
            'datasource_id' => 1,
            'external_id' => 123123123
        ]);
    }
}
