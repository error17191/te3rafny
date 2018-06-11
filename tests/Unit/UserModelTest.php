<?php

namespace Tests\Unit;

use App\Choice;
use App\Question;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_add_question_to_him_with_specifying_correct_answer()
    {
        $user = factory(User::class)->create();
        $question = factory(Question::class)->create();
        $choices = factory(Choice::class, 3)->create([
            'question_id' => $question->id
        ]);

        $user->addQuestion($question, $choices[1]);

        $this->assertCount(1, $user->questions);

        $this->assertEquals($question->id, $user->questions->first()->id);

        $this->assertEquals($choices[1]->id, $user->questions->first()->pivot->correct_choice_id);

    }

    /** @test */

    public function can_check_if_a_choice_is_his_correct_choice_for_some_question()
    {
        $user = factory(User::class)->create();
        $question = factory(Question::class)->create();
        $choices = factory(Choice::class, 3)->create([
            'question_id' => $question->id
        ]);

        $user->addQuestion($question, $choices[1]);

        $this->assertTrue($user->isCorrectChoice($question, $choices[1]));
    }

    /** @test */

    public function it_returns_null_when_trying_to_get_correct_choice_id_for_question_not_added_to_it()
    {
        $user = factory(User::class)->create();
        $question = factory(Question::class)->create();

        $this->assertNull($user->getCorrectChoiceId($question));
    }


    /** @test */

    public function it_returns_null_when_trying_to_get_correct_choice_for_question_not_added_to_it()
    {
        $user = factory(User::class)->create();
        $question = factory(Question::class)->create();

        $this->assertNull($user->getCorrectChoice($question));
    }


}
