<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\SubMenuItem;
use App\Models\SubPage;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {

        SubPage::insert([
            'title_ru' => $request->title_ru,
            'title_tj' => $request->title_tj,
            'title_en' => $request->title_en,
            'title_fr' => $request->title_fr,
            'title_es' => $request->title_es,
            'title_ch' => $request->title_ch,
            'url' => strtolower(str_replace(' ', '-', $request->title_en)),
            'text_ru' => $request->text_ru,
            'text_tj' => $request->text_tj,
            'text_en' => $request->text_en,
            'text_fr' => $request->text_fr,
            'text_es' => $request->text_es,
            'text_ch' => $request->text_ch,
            'status' => $request->status,
            'page_id' => $request->page_id,
            'sort' => $request->sort,
            'created_at' => now(),
            'updated_at' => now(),
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
    public function update(Request $request)
    {
        $submenu_id = $request->id;

        SubPage::findOrFail($submenu_id)->update([
            'title_ru' => $request->title_ru,
            'title_tj' => $request->title_tj,
            'title_en' => $request->title_en,
            'title_fr' => $request->title_fr,
            'title_es' => $request->title_es,
            'title_ch' => $request->title_ch,
            'url' => strtolower(str_replace(' ', '-', $request->title_en)),
            'text_ru' => $request->text_ru,
            'text_tj' => $request->text_tj,
            'text_en' => $request->text_en,
            'text_fr' => $request->text_fr,
            'text_es' => $request->text_es,
            'text_ch' => $request->text_ch,
            'status' => $request->status,
            'page_id' => $request->page_id,
            'sort' => $request->sort,
            'created_at' => now(),
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
    public function delete(SubPage $subMenuItem, $id)
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
