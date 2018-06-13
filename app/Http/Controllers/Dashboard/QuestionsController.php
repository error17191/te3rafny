<?php

namespace App\Http\Controllers\Dashboard;

use App\Choice;
use App\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuestionsController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'choices' => 'required|array|min:2',
            'choices.*' => 'string|max:100',
            'question' => 'required|string|max:255'
        ]);

        $question = Question::create([
            'content' => $request->question,
        ]);

        $choices = [];

        foreach ($request->choices as $choiceContent) {
            $choice = new Choice();
            $choice->content = $choiceContent;
            $choices[] = $choice;
        }

        $question->choices()->saveMany($choices);


        return response()->json([
            'created' => true
        ]);
    }
}
