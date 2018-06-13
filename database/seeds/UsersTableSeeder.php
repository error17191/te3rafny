<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        User::truncate();

        User::create([
            'name' => 'Mohamed Ahmed',
            'email' => 'mohamed@mail.com',
            'password' => bcrypt('123456'),
            'admin' => true
        ]);
    }
}
