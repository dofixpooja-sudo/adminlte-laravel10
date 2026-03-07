<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Option;
use App\Models\Question;

class OptionController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'question_id' => 'required',
        'option_text' => 'required'
    ]);

    $option = Option::create([
        'question_id' => $request->question_id,
        'option_text' => $request->option_text
    ]);

    return response()->json([
        'status' => true,
        'message' => 'Option created successfully',
        'data' => $option
    ]);
}
}