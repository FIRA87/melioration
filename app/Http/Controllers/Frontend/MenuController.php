<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\SubPage;
use App\Models\SubSubPage;
use Illuminate\Http\Request;

class MenuController extends Controller
{

    public function showMenu()
    {
        $menus = Page::with('submenus.subSubmenus')->get();
        return view('menu', ['menus' => $menus]);
    }

    public function menuShow(Page $menu)
    {
        // Получаем все подменю текущего меню
       // $all_submenus = $menu->submenus()->with('subSubmenus')->orderBy('sort', 'asc')->get();
        $all_submenus = $menu->submenus()->orderBy('sort', 'asc')->get();

        return view('frontend.pages.page_details', [
            
            'menu' => $menu,
            'all_submenus' => $all_submenus, // Все подменю и их подменю
            'currentMenu' => $menu, // Текущее меню
        ]);
    }

    public function subMenuShow(SubPage $submenu)
    {
        $menu = $submenu->page; // Получаем родительское меню

        // Получаем все подменю текущего меню
       // $all_submenus = $menu->submenus()->with('subSubmenus')->where('status', '1')->get();
         $all_submenus = $menu->submenus()->where('status', '1')->get();


        return view('frontend.pages.sub_page_details', [
            'submenu' => $submenu,
            'menu' => $menu,
            'all_submenus' => $all_submenus, // Все подменю и их подменю
            'currentMenu' => $menu, // Текущее меню
        ]);
    }

    public function sub_subMenuShow(SubSubPage $sub_submenu)
    {
        $submenu = $sub_submenu->subPage; // Получаем родительское подменю
        $menu = $submenu->page; // Получаем родительское меню

        // Получаем все подменю текущего меню
        $all_submenus = $menu->submenus()->with('subSubmenus')->orderBy('sort', 'asc')->where('status', '1')->get();

        return view('frontend.pages.sub_sub_page_details', [
            'sub_submenu' => $sub_submenu,
            'submenu' => $submenu,
            'menu' => $menu,
            'all_submenus' => $all_submenus, // Все подменю и их подменю
            'currentMenu' => $menu, // Текущее меню
        ]);
    }




}
