<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;

class QuestionController extends Controller
{
    public function index($categoryId)
    {
        $questions = Question::with('answers')->where('category_id', $categoryId)->latest()->get();
        return view('admin.category.questions', compact('questions','categoryId'));
    }

   public function store(Request $request)
{
    $request->validate([
        'question'    => 'required|string',
        'category_id' => 'required',
        'answer_type' => 'required|in:text,options',

        'text_answer' => 'nullable|required_if:answer_type,text|string',
        'options'     => 'nullable|required_if:answer_type,options|array',
        'options.*'   => 'nullable|string',
    ]);

    // ✅ SAVE QUESTION
    $question = Question::create([
        'question'    => $request->question,
        'category_id' => $request->category_id,
        'answer_type' => $request->answer_type,
    ]);

    // ✅ SAVE TEXT ANSWER
    if ($request->answer_type === 'text') {
        Answer::create([
            'question_id' => $question->id,
            'answer'      => $request->text_answer,
        ]);
    }

    // ✅ SAVE OPTIONS
    if ($request->answer_type === 'options') {
        foreach ($request->options as $opt) {
            if (!empty($opt)) {
                Answer::create([
                    'question_id' => $question->id,
                    'answer'      => $opt,
                ]);
            }
        }
    }

    return redirect()
        ->route('admin.questions.index', $request->category_id)
        ->with('success', 'Question added successfully');
}


public function edit($id)
{
    $question = Question::with('answers')->findOrFail($id);
    return view('admin.category.update-question', compact('question'));
}



public function update(Request $request, $id)
{
    $request->validate([
        'question'    => 'required|string',
        'answer_type' => 'required|in:text,options',
        'text_answer' => 'nullable|required_if:answer_type,text',
        'options'     => 'nullable|required_if:answer_type,options|array',
    ]);

    $question = Question::findOrFail($id);

    // 1️⃣ Update question
    $question->update([
        'question'    => $request->question,
        'answer_type' => $request->answer_type,
    ]);

    // 2️⃣ DELETE OLD ANSWERS (THIS FIXES YOUR ISSUE)
    $question->answers()->delete();

    // 3️⃣ SAVE NEW ANSWER
    if ($request->answer_type === 'text') {
        Answer::create([
            'question_id' => $question->id,
            'answer'      => $request->text_answer,
        ]);
    }

    if ($request->answer_type === 'options') {
        foreach ($request->options as $opt) {
            if (!empty($opt)) {
                Answer::create([
                    'question_id' => $question->id,
                    'answer'      => $opt,
                ]);
            }
        }
    }

    return redirect()->back()->with('success','Question updated successfully');
}






    public function destroy($id)
{
    $question = Question::findOrFail($id);

    $question->answers()->delete();

    $question->delete();

    return redirect()->back()->with('success','Question & answers deleted successfully.');
}

}
