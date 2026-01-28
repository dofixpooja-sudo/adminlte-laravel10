<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Question;

class QuestionController extends Controller
{
      public function index($categoryId)
    {
        $questions = Question::where('category_id', $categoryId)->get();

        return view('admin.category.questions', compact('questions', 'categoryId'));
    }
public function store(Request $request)
    {
        Question::create([
            'question' => $request->question,
            'category_id' => $request->category_id
        ]);

        return redirect()->back();
    }
    public function edit($id)
    {
        $question = Question::findOrFail($id);
        return view('admin.category.edit-question', compact('question'));
    }

   public function update(Request $request, $id)
{
    $question = Question::findOrFail($id);

    $question->update([
        'question' => $request->question,
        'category_id' => $request->category_id
    ]);

    return redirect()->route('admin.questions.index', $request->category_id);
}


    // 🗑 Delete
    public function destroy($id)
    {
        Question::findOrFail($id)->delete();
        return redirect()->back();
    }
}
