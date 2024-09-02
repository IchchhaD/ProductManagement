<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getCategory()
    {
        return response()->json(['message' => 'Getting Category']);
    }
    public function createCategory(Request $request)
    {
        return response()->json(['message' => 'Creating Category']);
    }
    public function updateCategory(Request $request, $id)
    {
        return response()->json(['message' => 'Updating Category']);
    }
    public function deleteCategory(Request $request)
    {
        return response()->json(['message' => 'Deleting Category']);
    }
}
