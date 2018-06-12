<?php

use Illuminate\Database\Seeder;
use App\Question;
use App\Choice;
use Illuminate\Support\Facades\DB;

class QuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        Question::truncate();
        Choice::truncate();

        factory(Question::class, 15)->create()
            ->each(function ($question) {
                factory(Choice::class, 3)->create(['question_id' => $question->id]);
            });
    }
}
