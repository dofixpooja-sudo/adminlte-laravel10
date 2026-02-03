<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;

class SubCategoryController extends Controller
{
    public function categoryWiseSubcategories($category_id)
    {
        $category = Category::with('subcategories')
            ->where('status',1)
            ->find($category_id);

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
