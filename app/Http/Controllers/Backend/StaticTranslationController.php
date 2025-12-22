<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\StaticTranslation;
use Illuminate\Http\Request;

class StaticTranslationController extends Controller
{
    public function index()
    {
        $translations = StaticTranslation::orderBy('group')->orderBy('key')->paginate(20);
        $groups = StaticTranslation::distinct()->pluck('group');
        
        return view('backend.translations.index', compact('translations', 'groups'));
    }

    public function create()
    {
        return view('backend.translations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'key' => 'required|unique:static_translations,key',
            'value_ru' => 'required',
            'value_en' => 'required',
            'value_tj' => 'required',
            'group' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        StaticTranslation::create($request->all());

        return redirect()->route('static-translations.index')->with('success', 'Перевод добавлен');
    }

    public function edit($id)
    {
        $translation = StaticTranslation::findOrFail($id);
        return view('backend.translations.edit', compact('translation'));
    }

    public function update(Request $request, $id)
    {
        $translation = StaticTranslation::findOrFail($id);

        $request->validate([
            'key' => 'required|unique:static_translations,key,' . $id,
            'value_ru' => 'required',
            'value_en' => 'required',
            'value_tj' => 'required',
            'group' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        $translation->update($request->all());

        return redirect()->route('static-translations.index')->with('success', 'Перевод обновлен');
    }

    public function destroy($id)
    {
        $translation = StaticTranslation::findOrFail($id);
        $translation->delete();

        return redirect()->route('static-translations.index')->with('success', 'Перевод удален');
    }
}