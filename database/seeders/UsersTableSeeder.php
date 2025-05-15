<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(30)->create();

        $user = User::find(1);
        $user->name = 'liang';
        $user->email = 'liang@liang.com';
        $user->password = bcrypt('liang');
        $user->is_admin = true;
        $user->save();
    }
}
