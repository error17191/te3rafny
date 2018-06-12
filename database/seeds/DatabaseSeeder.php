<?php

use Illuminate\Database\Seeder;
use App\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Mohamed Ahmed',
            'email' => 'mohamed@mail.com',
            'password' => bcrypt('123456')
        ]);

        $this->call(QuestionsSeeder::class);
    }
}
