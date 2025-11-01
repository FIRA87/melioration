<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

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

    public function storeCategory(Request $request)
    {
         Category::insert([
            'title_ru' => $request->title_ru,
            'title_tj' => $request->title_tj,
            'title_en' => $request->title_en,
            'category_slug' => strtolower(str_replace(' ', '-', $request->title_en)),
            'position' => $request->position,
            'active' => $request->active,
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

    public function updateCategory(Request $request)
    {
        $cat_id = $request->id;

        Category::findOrFail($cat_id)->update([
            'title_ru' => $request->title_ru,
            'title_tj' => $request->title_tj,
            'title_en' => $request->title_en,
            'category_slug' => strtolower(str_replace(' ', '-', $request->title_en)),
            'position' => $request->position,
            'active' => $request->active,
            'created_at' => now(),
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


    public function getSubCategory($category_id){
        $subcat = Subcategory::where('category_id', $category_id)->orderBy('title_ru', 'ASC')->get();
        return json_encode($subcat);
    }

}
