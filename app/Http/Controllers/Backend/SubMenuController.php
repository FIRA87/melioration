<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Models\Page;
use App\Models\SubPage;
use App\Models\PageImage;
use Illuminate\Http\Request;
use App\Http\Requests\SubMenuRequest;
use Illuminate\Support\Str;

class SubMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $submenu= SubPage::all();
        $menu= Page::where('status', 1)->get();
        return view('backend.submenu.index', compact('submenu', 'menu'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $menuItem= Page::where('status', 1)->get();
        return view('backend.submenu.create', compact('menuItem'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubMenuRequest $request)
    {
        $data = $request->validated();

        $subPage = SubPage::create([
            'title_ru' => $data['title_ru'],
            'title_tj' => $data['title_tj'] ?? null,
            'title_en' => $data['title_en'],
            'url' => Str::slug($data['title_en']),
            'text_ru' => $data['text_ru'] ?? null,
            'text_tj' => $data['text_tj'] ?? null,
            'text_en' => $data['text_en'] ?? null,
            'status' => $data['status'],
            'page_id' => $data['page_id'],
            'sort' => $data['sort'] ?? null,
        ]);

        // Handle multiple image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('upload/subpages/'), $imageName);
                
                $subPage->images()->create([
                    'image' => $imageName,
                    'sort_order' => $index,
                ]);
            }
        }

        $notification = array(
            'message' =>'Страница успешно добавлена',
            'alert-type'=> 'success'
        );
        return redirect()->route('all.submenu')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $submenu = SubPage::findOrFail($id);
        $menu = Page::all();
        return view('backend.submenu.edit',compact('submenu', 'menu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubMenuRequest $request)
    {
        $data = $request->validated();
        $submenu_id = $request->id;

        $subPage = SubPage::findOrFail($submenu_id);
        
        $subPage->update([
            'title_ru' => $data['title_ru'],
            'title_tj' => $data['title_tj'] ?? null,
            'title_en' => $data['title_en'],
            'url' => Str::slug($data['title_en']),
            'text_ru' => $data['text_ru'] ?? null,
            'text_tj' => $data['text_tj'] ?? null,
            'text_en' => $data['text_en'] ?? null,
            'status' => $data['status'],
            'page_id' => $data['page_id'],
            'sort' => $data['sort'] ?? null,
            'updated_at' => now(),
        ]);

        // Handle image deletion
        if ($request->has('delete_images') && is_array($request->delete_images)) {
            foreach ($request->delete_images as $imageId) {
                $pageImage = $subPage->images()->find($imageId);
                if ($pageImage) {
                    // Delete physical file
                    $imagePath = public_path('upload/subpages/' . $pageImage->image);
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                    // Delete from database
                    $pageImage->delete();
                }
            }
        }

        // Handle new image uploads
        if ($request->hasFile('images')) {
            $currentMaxOrder = $subPage->images()->max('sort_order') ?? -1;
            
            foreach ($request->file('images') as $index => $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('upload/subpages/'), $imageName);
                
                $subPage->images()->create([
                    'image' => $imageName,
                    'sort_order' => $currentMaxOrder + $index + 1,
                ]);
            }
        }

        $notification = array(
            'message' =>'Страница успешно обновлена',
            'alert-type'=> 'success'
        );
        return redirect()->route('all.submenu')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        SubPage::findOrFail($id)->delete();
        $notification = array(
            'message' =>'Страница успешно удалена',
            'alert-type'=> 'success'
        );
        return redirect()->back()->with($notification);
    }

    // UPDATE STATUS
    public function updateStatus(Request $request, SubPage $subMenuItem){
        if($request->ajax()){
            $data = $request->all();
            if($data['status']=='Active'){
                $status = 0;
            } else {
                $status = 1;
            }
            SubPage::where('id', $data['page_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'page_id'=>$data['page_id']]);
        }

    }

    /**
     * Delete a single image via AJAX
     * Удаляет изображение подменю через AJAX запрос
     */
    public function deleteImage(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'Разрешен только AJAX запрос'
            ], 400);
        }

        $request->validate([
            'image_id' => 'required|integer|exists:page_images,id'
        ]);

        $imageId = $request->image_id;
        $pageImage = PageImage::find($imageId);
        
        if (!$pageImage) {
            return response()->json([
                'success' => false,
                'message' => 'Изображение не найдено'
            ], 404);
        }

        // Проверяем, что изображение принадлежит модели SubPage
        if ($pageImage->imageable_type !== SubPage::class) {
            return response()->json([
                'success' => false,
                'message' => 'Изображение не принадлежит подменю'
            ], 403);
        }

        try {
            // Удаляем физический файл
            $imagePath = public_path('upload/subpages/' . $pageImage->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            
            // Удаляем из базы данных
            $pageImage->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Изображение успешно удалено'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка при удалении изображения: ' . $e->getMessage()
            ], 500);
        }
    }

}
