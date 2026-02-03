<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;

class QuestionController extends Controller
{
    public function index($subcategoryId)
    {
        $questions = Question::where('subcategory_id', $subcategoryId)
            ->latest()
            ->get();

        return view('admin.subcategory.questions',
            compact('questions','subcategoryId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string',
            'subcategory_id' => 'required',
            'answer_type' => 'required|in:text,options',
        ]);

        Question::create([
            'question' => $request->question,
            'subcategory_id' => $request->subcategory_id,
            'answer_type' => $request->answer_type,
        ]);

        return redirect()
            ->route('admin.questions.index', $request->subcategory_id)
            ->with('success', 'Question added successfully');
    }

    public function edit($id)
    {
        $question = Question::findOrFail($id);
        return view('admin.subcategory.update-question', compact('question'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'question' => 'required|string',
            'answer_type' => 'required|in:text,options',
        ]);

        Question::findOrFail($id)->update([
            'question' => $request->question,
            'answer_type' => $request->answer_type,
        ]);

        return redirect()->back()->with('success','Updated');
    }

    public function destroy($id)
    {
        Question::findOrFail($id)->delete();
        return back()->with('success','Deleted');
    }
}

