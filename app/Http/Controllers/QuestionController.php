<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;

class QuestionController extends Controller
{
    public function index($categoryId)
    {
        $questions = Question::where('category_id', $categoryId)->latest()->get();
        return view('admin.category.questions', compact('questions','categoryId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'question'    => 'required|string',
            'category_id' => 'required',
            'answer_type' => 'required|in:text,options',
        ]);

        Question::create([
            'question'    => $request->question,
            'category_id' => $request->category_id,
            'answer_type' => $request->answer_type,
        ]);

        return redirect()
            ->route('admin.questions.index', $request->category_id)
            ->with('success', 'Question added successfully');
    }

    public function edit($id)
    {
        $question = Question::findOrFail($id);
        return view('admin.category.update-question', compact('question'));
    }

   public function update(Request $request, $id)
{
    $request->validate([
        'question'    => 'required|string',
        'answer_type' => 'required|in:text,options',
    ]);

    $question = Question::findOrFail($id);

    $question->update([
        'question'    => $request->question,
        'answer_type' => $request->answer_type,
    ]);

    return redirect()->route('admin.questions.index', $question->category_id)
        ->with('success', 'Question updated successfully');
}


    public function destroy($id)
    {
        Question::findOrFail($id)->delete();
        return redirect()->back()->with('success','Question deleted successfully.');
    }
}
