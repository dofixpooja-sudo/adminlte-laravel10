<?php

namespace App\Http\Controllers\Api;
use App\Models\Answer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Option;
class AnswerController extends Controller
{


public function edit($id)
{
    $answer = Answer::with(['question','option'])->findOrFail($id);

    $options = Option::where('question_id',$answer->question_id)->get();

    return view('answer.edit', compact('answer','options'));
}
public function index()
{
   

$answers = Answer::with(['question','option'])->get();

    return response()->json([
        'status' => true,
        'data' => $answers
    ]);
}
public function destroy($id)
{
    $answer = Answer::findOrFail($id);
    $answer->delete();

    return redirect()->back()->with('success','Answer deleted successfully');
}
public function answersList()
{
    $answers = Answer::with(['question','option'])
                ->orderBy('created_at','desc')
                ->get();

    return view('answers.index', compact('answers'));
}
 public function store(Request $request)
{
    $request->validate([
        'user_id' => 'required',
        'question_id' => 'required'
    ]);

    $question = Question::find($request->question_id);

    if(!$question){
        return response()->json([
            'status' => false,
            'message' => 'Question not found'
        ]);
    }

    // QUESTION TYPE = TEXT
    if($question->answer_type == 'text'){

        if(!$request->answer_text){
            return response()->json([
                'status'=>false,
                'message'=>'This question only accepts text answers'
            ]);
        }

        $answer = Answer::create([
            'user_id' => $request->user_id,
            'question_id' => $request->question_id,
            'answer_type' => 'text',
            'answer_text' => $request->answer_text,
            'option_id' => null
        ]);
    }

    // QUESTION TYPE = OPTIONS
  elseif($question->answer_type == 'option' || $question->answer_type == 'options'){

    if(!$request->option_id){
        return response()->json([
            'status'=>false,
            'message'=>'This question only accepts option answers'
        ]);
    }

    $answer = Answer::create([
        'user_id' => $request->user_id,
        'question_id' => $request->question_id,
        'answer_type' => 'option',
        'option_id' => $request->option_id,
        'answer_text' => null
    ]);
}

    else{
        return response()->json([
            'status'=>false,
            'message'=>'Invalid question type'
        ]);
    }

    return response()->json([
        'status'=>true,
        'message'=>'Answer submitted successfully',
        'data'=>$answer
    ]);
}


public function update(Request $request,$id)
{

    $answer = Answer::find($id);

    if(!$answer){
        return redirect()->back()->with('error','Answer not found');
    }

    if($answer->answer_type == 'text'){

        $request->validate([
            'answer_text'=>'required'
        ]);

        $answer->update([
            'answer_text'=>$request->answer_text
        ]);
    }

    elseif($answer->answer_type == 'option'){

        $request->validate([
            'option_id'=>'required'
        ]);

        $answer->update([
            'option_id'=>$request->option_id
        ]);
    }

    return redirect()->route('dashboard')
           ->with('success','Answer updated successfully');
}

// public function delete($id)
// {

//     $answer = Answer::find($id);

//     if(!$answer){
//         return response()->json([
//             'status'=>false,
//             'message'=>'Answer not found'
//         ]);
//     }

//     $answer->delete();

//     return response()->json([
//         'status'=>true,
//         'message'=>'Answer deleted successfully'
//     ]);
// }

// public function answersList()
// {
//     $answers = Answer::with(['question','option'])
//                      ->orderBy('created_at','desc') // recent first
//                      ->get();

//     return view('answers.index', compact('answers'));
// }
}