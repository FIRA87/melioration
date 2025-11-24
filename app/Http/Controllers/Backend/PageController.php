<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\Page;
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
		
				
        Page::create([
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
    public function edit(Page $page, $id)
    {
        $pages = Page::findorFail($id);
        return view('backend.pages.edit',compact('pages'));
    }

    /**
     * Update the specified resource in storage.
     */
		public function update(PageRequest $request)
		{
				$data = $request->validated();
				$page_id = $request->id;// Сохраняем $page_id на случай, если route model binding не сработает
		
				Page::findOrFail($page_id)->update([
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


}
