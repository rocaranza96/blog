<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::withTrashed()->paginate();

        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        /* This code block is storing an uploaded file in the 'public/category/covers' directory and
        assigning the file path to the variable cover_name. */
        $cover_name = $request->input('name').'.'.$request->file('cover')->getClientOriginalExtension();
        $path = $request->file('cover')->storeAs('public/category/covers', $cover_name);

        Category::create([
            'name' => $request->input('name'),
            'cover_path' => $path,
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        /* This code block is updating the cover image of a category. It first checks if a new cover
        image has been uploaded by the user by checking if the request has a file with the key
        'cover'. If a new cover image has been uploaded, it generates a new file name by
        concatenating the category name with the original file extension of the uploaded file. It
        then stores the uploaded file in the 'public/category/covers' directory with the generated
        file name using the `storeAs` method of the uploaded file. If the category already had a
        cover image, it deletes the old cover image using the `delete` method of the `Storage`
        facade. Finally, it updates the category record in the database with the new cover image
        path or the old cover image path if no new cover image was uploaded. */
        $path = null;
        if ($request->hasFile('cover')) {
            $cover_name = $request->input('name').'.'.$request->file('cover')->getClientOriginalExtension();

            $path = $request->file('cover')->storeAs('public/category/covers', $cover_name);
            Storage::delete($category->cover_path);
        }

        $category->update([
            'name' => $request->input('name'),
            'cover_path' => $path ?? $category->cover_path,
        ]);

        return redirect()->route('admin.category.edit', strtolower($category->name));
    }

    /**
     * Force remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        Storage::delete($category->cover_path);
        $category->forceDelete();

        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function softDelete(Category $category)
    {
        $category->delete();

        return redirect()->back();
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore(Category $category)
    {
        $category->restore();

        return redirect()->back();
    }
}
