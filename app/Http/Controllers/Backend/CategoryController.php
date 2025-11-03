<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{

    public function allCategory()
    {
        $categories = Category::all();
        return view('backend.category.index', compact('categories'));
    }

    public function addCategory()
    {
        return view('backend.category.create');
    }

    public function storeCategory(CategoryRequest $request)
    {
        $data = $request->validated();

        Category::insert([
            'title_ru' => $data['title_ru'],
            'title_tj' => $data['title_tj'] ?? null,
            'title_en' => $data['title_en'],
            'category_slug' => strtolower(str_replace(' ', '-', $data['title_en'])),
            'position' => $data['position'] ?? 0,
            'status' => (int)$data['status'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $notification = array(
            'message' =>'Категория успешно добавлена',
            'alert-type'=> 'success'
        );
        return redirect()->route('all.category')->with($notification);
    }

    public function editCategory($id)
    {
       $category = Category::findorFail($id);
       return view('backend.category.edit',compact('category'));
    }

    public function updateCategory(CategoryRequest $request)
    {
        $data = $request->validated();
        $cat_id = $request->id;

        Category::findOrFail($cat_id)->update([
            'title_ru' => $data['title_ru'],
            'title_tj' => $data['title_tj'] ?? null,
            'title_en' => $data['title_en'],
            'category_slug' => strtolower(str_replace(' ', '-', $data['title_en'])),
            'position' => $data['position'] ?? 0,
            'status' => (int)$data['status'],
            'updated_at' => now(),
        ]);

        $notification = array(
            'message' =>'Категория успешно обновлена',
            'alert-type'=> 'success'
        );
        return redirect()->route('all.category')->with($notification);
    }

    public function deleteCategory($id)
    {
        Category::findOrFail($id)->delete();
        $notification = array(
            'message' =>'Категория успешно удалена',
            'alert-type'=> 'success'
        );
        return redirect()->back()->with($notification);
    }



}
