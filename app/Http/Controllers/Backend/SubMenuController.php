<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Models\Page;
use App\Models\SubPage;
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

        SubPage::create([
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
    public function edit(Page $page, $id)
    {
        $submenu = SubPage::findorFail($id);
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

        SubPage::findOrFail($submenu_id)->update([
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



}
