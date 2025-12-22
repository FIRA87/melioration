<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PageImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PageRequest;
use Illuminate\Support\Str;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pages = Page::get();
        return view('backend.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
		public function store(PageRequest $request)
		{
				$data = $request->validated();
                $page = Page::create([
                    'title_ru' => $data['title_ru'],
                    'title_tj' => $data['title_tj'] ?? '',
                    'title_en' => $data['title_en'],
                    'text_ru' => $data['text_ru'] ?? '',
                    'text_tj' => $data['text_tj'] ?? '',
                    'text_en' => $data['text_en'] ?? '',
                    'status' => $data['status'],
                    'sort' => $data['sort'] ?? 0,
                    'url' => Str::slug($data['title_en']),
                ]);

            // Handle multiple image uploads
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $index => $image) {
                    $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('upload/pages/'), $imageName);
                    
                    $page->images()->create([
                        'image' => $imageName,
                        'sort_order' => $index,
                    ]);
                }
            }
		
            return redirect()->route('all.pages')->with([
                    'message' => 'Страница успешно добавлена',
                    'alert-type' => 'success'
            ]);
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
        $pages = Page::findOrFail($id);
        return view('backend.pages.edit',compact('pages'));
    }

    /**
     * Update the specified resource in storage.
     */
	public function update(PageRequest $request)
	{
			$data = $request->validated();
			$page_id = $request->id;// Сохраняем $page_id на случай, если route model binding не сработает
	
			$page = Page::findOrFail($page_id);
			
			$page->update([
					'title_ru' => $data['title_ru'],
					'title_tj' => $data['title_tj'] ?? '',
					'title_en' => $data['title_en'],
					'text_ru' => $data['text_ru'] ?? '',
					'text_tj' => $data['text_tj'] ?? '',
					'text_en' => $data['text_en'] ?? '',
					'status' => $data['status'],
					'sort' => $data['sort'] ?? 0,
					'updated_at' => now(),
            'url' => Str::slug($data['title_en']),
			]);

			// Handle image deletion
			if ($request->has('delete_images') && is_array($request->delete_images)) {
				foreach ($request->delete_images as $imageId) {
					$pageImage = $page->images()->find($imageId);
					if ($pageImage) {
						// Delete physical file
						$imagePath = public_path('upload/pages/' . $pageImage->image);
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
				$currentMaxOrder = $page->images()->max('sort_order') ?? -1;
				
				foreach ($request->file('images') as $index => $image) {
					$imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
					$image->move(public_path('upload/pages/'), $imageName);
					
					$page->images()->create([
						'image' => $imageName,
						'sort_order' => $currentMaxOrder + $index + 1,
					]);
				}
			}
	
			return redirect()->route('all.pages')->with([
					'message' => 'Страница успешно обновлена',
					'alert-type' => 'success'
			]);
	}	

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        Page::findOrFail($id)->delete();
        $notification = array(
            'message' =>'Страница успешно удалена',
            'alert-type'=> 'success'
        );
        return redirect()->back()->with($notification);
    }

    // UPDATE STATUS
    public function updateStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $status = ($data['status'] == 'Active') ? 0 : 1;

            if (isset($data['type']) && $data['type'] == 'sub_page') {
                // Обновляем подменю
                DB::table('sub_pages')->where('id', $data['page_id'])->update(['status' => $status]);

                return response()->json([
                    'status' => $status,
                    'sub_page_id' => $data['page_id'],
                    'type' => 'sub_page'
                ]);
            } else {
                // Обновляем меню
                DB::table('pages')->where('id', $data['page_id'])->update(['status' => $status]);

                // При необходимости можно также обновить все sub_pages, связанные с этой страницей:
                DB::table('sub_pages')->where('page_id', $data['page_id'])->update(['status' => $status]);

                return response()->json([
                    'status' => $status,
                    'page_id' => $data['page_id'],
                    'type' => 'page'
                ]);
            }
        }
    }

    /**
     * Delete a single image via AJAX
     * Удаляет изображение страницы через AJAX запрос
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

        // Проверяем, что изображение принадлежит модели Page
        if ($pageImage->imageable_type !== Page::class) {
            return response()->json([
                'success' => false,
                'message' => 'Изображение не принадлежит странице'
            ], 403);
        }

        try {
            // Удаляем физический файл
            $imagePath = public_path('upload/pages/' . $pageImage->image);
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
