<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\Upload\UploadService;
use Illuminate\Http\Request;
use File;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::get();
        return view('backend.category.index', [
            'categories' => $categories
        ]);
    }

    public function create()
    {
        return view('backend.category.create', [
            // 'campaigns' => $campaigns
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'name' => 'required|max:255|unique:categories',
            'slug' => 'required|max:255|unique:categories',
        ]);
        
        if($request->file('image')){
            $file = (new UploadService())->saveFile($request->file('image'), 'images/categories'); 
            $validatedData['image'] = $file["name"];
        }

        
   

        Category::create($validatedData);

        return redirect('/category')->with('success', 'New Category Added!');

    }

    public function destroy(Category $campaign, $id)
    {
        $category = Category::find($id);
        
        if ($category->image != null) {
            if(File::exists(public_path('images/categories/'. $category->image))){
                File::delete(public_path('images/categories/'. $category->image));
            }
        }
        
        $category->delete();
        
        return redirect('/category')->with('success', 'Category has been deleted!');
    }

    public function edit($id)
    {
        $category = Category::where('id', $id)->first();

        return view('backend.category.edit', [
            'category' => $category,
            // 'categories' => $categories,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required|max:255',
        ]);

        $category = Category::find($id);

        if ($request->file('image')) {
            if (File::exists(public_path('/images/categories/' . $category->image))) {
                File::delete(public_path('/images/categories/' . $category->image));

                $file = (new UploadService())->saveFile($request->file('image'), 'images/categories');
            } else {
                $file = (new UploadService())->saveFile($request->file('image'), 'images/categories');
            }
            $validatedData['image'] = $file["name"];
          
        }

        $category->update($validatedData);
        // Campaign::create($validatedData);

        return redirect('/category')->with('success', 'Category has been Edited!');
    }

    
}
