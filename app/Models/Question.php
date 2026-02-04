<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Answer;

class Question extends Model
{
    protected $fillable = [
        'subcategory_id',
        'question',
        'answer_type'
    ];

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}

