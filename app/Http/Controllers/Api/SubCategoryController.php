<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;

class SubCategoryController extends Controller
{
    public function categoryWiseSubcategories($category_id)
    {
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

        if (!$category) {
            return response()->json([
                'status' => false,
                'message' => 'Category not found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'category' => [
                'id' => $category->id,
                'name' => $category->name,
            ],
            'subcategories' => $category->subcategories
        ]);
    }
}
