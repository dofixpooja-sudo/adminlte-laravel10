<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class SubCategoryController extends Controller
{
    public function categoryWiseSubcategories($category_id)
    {
    
        $validator = Validator::make(
            ['category_id' => $category_id],
            [
                'category_id' => 'required|integer|exists:categories,id'
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

       
        $category = Category::with([
            'subcategories' => function ($q) {
                $q->select('id','category_id','name','slug')
                  ->with([
                      'questions' => function ($q2) {
                          $q2->select('id','subcategory_id','question','answer_type')
                             ->with('answers:id,question_id,answer');
                      }
                  ]);
            }
        ])->find($category_id);

        return response()->json([
            'status' => true,
            'category' => [
                'id'   => $category->id,
                'name' => $category->name,
            ],
            'subcategories' => $category->subcategories
        ], 200);
    }
}
