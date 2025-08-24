<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(3);
        return view('Dashboard.Categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parents = Category::all();
        $category = new Category();
        return view('Dashboard.Categories.create',compact('parents', 'category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $clean_data = $request->validate(Category::rules(),[
            'name.unique' => 'Category name must be unique' ,
            'required' => 'This field (:attribute) is required'
        ]);
        // dd($clean_data); //* include only validated data in our case not include all data(description missing)
        $request->merge([
            'slug' => Str::slug($request->name)
        ]);

        $data = $request->all();
        $data['image']= $this->uploadImage($request);

        Category::create($data);
        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::findOrFail($id);
        return view('Dashboard.Categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        $parents = Category::where('id', '!=', $id)
            ->where(function ($query) use($id){
                $query->whereNull('parent_id')
                    ->orWhere('parent_id', '!=', $id);
            })->get();
        return view('Dashboard.Categories.edit', compact('category', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        // $clean_data = $request->validate(Category::rules($id)); //* now not need this line cuz i used custom validation
        $category = Category::findOrFail($id);
        $data = $request->except('image');
        $oldImg = $category->image;

        $path= $this->uploadImage($request);
        if($path) {
            $data['image'] = $path;
        }
        if ($oldImg && isset($data['image'])) {
            Storage::disk('public')->delete($oldImg);
        }

        $category->update($data);
        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Category::destroy($id);
        $category = Category::findOrFail($id);
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
    public function uploadImage(Request $request)
    {
        if(!$request->hasFile('image')) {
            return;
        }
        $file = $request->file('image');
        $path = $file->store('categories', 'public');
        return $path;
    }
}
