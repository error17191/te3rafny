<?php

namespace App\Http\Controllers;

use App\Choice;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MakeYourTestController extends Controller
{
    const MIN_TEST_QUESTIONS = 5;
    const MAX_TEST_QUESTIONS = 7;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('make-your-test.index');
    }

    public function init()
    {
        return response()->json([
            'urls' => [
                'random' => route('make-your-test.random'),
                'skip' => route('make-your-test.skip'),
                'accept' => route('make-your-test.accept'),
            ],
            'numbers' => [
                'min' => self::MIN_TEST_QUESTIONS,
                'max' => self::MAX_TEST_QUESTIONS,
                'accepted' => DB::table('user_questions')->where('user_id', auth()->id())->count(),
                'skipped' => DB::table('skipped_questions')->where('user_id', auth()->id())->count()
            ]
        ]);
    }

    public function random()
    {
        // Make sure the user didn't reach his limit of questions
        // if the user reached end before reaching the limit and has skipped questions clear skipped questions
        // if the user reached end before reaching the limit and has not skipped questions don't send questions
        $allQuestionsCount = Question::count();

        if ($allQuestionsCount == 0) {
            return response()->json([
                'no_questions' => true
            ]);
        }

        $userQuestionsIds = auth()->user()->questions()->pluck('question_id');
        $skippedQuestionsIds = DB::table('skipped_questions')->where('user_id', auth()->id())->pluck('question_id');

        // Users reached the maximum number of questions per test
        if (count($userQuestionsIds) == self::MAX_TEST_QUESTIONS) {
            return response()->json([
                'reached_limit' => true
            ]);
        }
        // There's no more questions except the skipped questions
        if (count($userQuestionsIds) + count($skippedQuestionsIds) == $allQuestionsCount) {
            DB::table('skipped_questions')->where('user_id', auth()->id())->delete();
            $skippedQuestionsIds = collect();
        }

        $question = Question::inRandomOrder()
            ->whereNotIn('id', $skippedQuestionsIds->merge($userQuestionsIds))->with('choices')->first();

        if (!$question) {
            return response()->json([
                'answered_all' => true
            ]);
        }

        return response()->json([
            'question' => $question,
            'numbers' => [
                'accepted' => count($userQuestionsIds),
                'all' => $allQuestionsCount,
                'skipped' => count($skippedQuestionsIds)
            ]
        ]);
    }

    public function skip(Request $request)
    {
        $question = Question::findOrFail($request->question);
        $skipped = DB::table('skipped_questions')->insert([
            'question_id' => $question->id,
            'user_id' => auth()->id()
        ]);

        return response()->json(compact('skipped'));
    }

    public function accept(Request $request)
    {
        $question = Question::findOrFail($request->question);
        $choice = Choice::findOrFail($request->choice);
        $accepted = DB::table('user_questions')->insert([
            'user_id' => auth()->id(),
            'question_id' => $question->id,
            'choice_id' => $choice->id
        ]);

        return response()->json(compact('accepted'));
    }

}
