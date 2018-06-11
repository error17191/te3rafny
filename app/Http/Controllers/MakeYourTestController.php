<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;

class MakeYourTestController extends Controller
{
    protected $acceptedQuestions;
    protected $skippedQuestions;
    protected $questionsToIgnore;

    const MIN_TEST_QUESTIONS = 4;

    public function __construct()
    {
        if (!session()->get('making-test')) {
            session()->put('making-test');
            $this->acceptedQuestions = [];
            $this->skippedQuestions = [];
            $this->questionsToIgnore = [];
            session()->put('accepted_questions', json_encode([]));
            session()->put('skipped_questions', json_encode([]));
        } else {
            $this->acceptedQuestions = $this->getAcceptedQuestions();
            $this->skippedQuestions = $this->getSkippedQuestions();
            $this->questionsToIgnore = array_merge($this->acceptedQuestions, $this->skippedQuestions);
        }
    }

    public function index()
    {
        return view('make-your-test.index');
    }

    public function random()
    {
        $count = Question::count();
        if ($count == count($this->questionsToIgnore)) {
            $this->clearSkippedQuestions();
        }
        $question = Question::inRandomOrder()->whereNotIn('id', $this->questionsToIgnore())->with('choices')->first();

        return response()->json(compact('question'));
    }


    protected function getAcceptedQuestions()
    {
        return collect(json_decode(
            session()->get('accepted_questions')
        ))->pluck('question')->all() ?: [];
    }

    protected function getAcceptedQuestionsWithChoices()
    {
        return json_decode(session()->get('accepted_questions')) ?: [];
    }

    protected function addToAcceptedQuestions($questionId, $choiceId)
    {
        $this->acceptedQuestions[] = ['question' => $questionId, 'choice' => $choiceId];

        session()->put('accepted_questions', json_encode($this->acceptedQuestions));
    }

    protected function getSkippedQuestions()
    {
        return json_decode(session()->get('skipped_questions')) ?: [];
    }

    protected function addToSkieppedQuestions($questionId)
    {
        $this->skippedQuestions[] = $questionId;

        session()->put('skipped_questions', json_encode($this->skippedQuestions));
    }

    protected function questionsToIgnore()
    {
        return array_merge($this->skippedQuestions(), $this->acceptedQuestions());
    }

    protected function clearSkippedQuestions()
    {
        session()->forget('skipped_questions');
        $this->questionsToIgnore = $this->acceptedQuestions;
    }
}
