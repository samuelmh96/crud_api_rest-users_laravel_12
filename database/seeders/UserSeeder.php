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
        $user1 = new User();
        $user1->name = 'admin';
        $user1->email = 'admin@gmail.com';
        $user1->password = bcrypt('12345678');
        $user1->save();

        $user2 = new User();
        $user2->name = 'lucas gerente';
        $user2->email = 'gerente@gmail.com';
        $user2->password = bcrypt('12345678');
        $user2->save();

        $user3 = new User();
        $user3->name = 'juan cajero';
        $user3->email = 'cajero@gmail.com';
        $user3->password = bcrypt('12345678');
        $user3->save();
    }
}
