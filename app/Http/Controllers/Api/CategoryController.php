<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', 1)
            ->select('id', 'name', 'slug')
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'Category list',
            'data' => $categories
        ]);
    }
}
