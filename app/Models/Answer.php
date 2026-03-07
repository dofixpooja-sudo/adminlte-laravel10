<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Answer;
class Answer extends Model
{


public function dashboard()
{
    $user = User::count();
    $category = Category::count();
    $product = Product::count();
    $collection = Collection::count();
    
    $answers = Answer::orderBy('created_at', 'desc')->get(); // recent first

    return view('admin.dashboard', compact('user','category','product','collection','answers'));
}
protected $fillable = [
    'user_id',
    'question_id',
    'answer_type',
    'option_id',
    'answer_text'
];


public function option()
{
    return $this->belongsTo(\App\Models\Option::class,'option_id');
}
public function user()
{
    return $this->belongsTo(\App\Models\User::class);
}

public function question()
{
    return $this->belongsTo(Question::class,'question_id');
}

}