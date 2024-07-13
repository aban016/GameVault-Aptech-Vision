<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.category', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|string|max:255',
        ]);

        try {
            $category = Category::create($request->all());
            $category->save();
            return redirect()->route('admin.categories')->with('success', 'Category added successfully');
        } catch (Exception $e) {
            return redirect()->route('admin.categories')->with('error', 'Something went wrong', $e);
        }
    }

    public function toggleStatus($id)
    {
        $category = Category::find($id);

        if ($category) {
            $category->is_active = !$category->is_active;
            $category->save();

            return redirect()->route('admin.categories')->with('success', 'Category status updated successfully!');
        } else {
            return redirect()->route('admin.categories')->with('error', 'Category not found!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return redirect()->route('admin.categories')->with('success', 'Category deleted successfully');
        } catch (Exception $e) {
            return redirect()->route('admin.categories')->with('error', $e);
        }
    }
}
