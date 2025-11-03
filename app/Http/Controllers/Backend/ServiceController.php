<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Http\Requests\ServiceRequest;

class ServiceController extends Controller
{
    /**
     * Отображает список всех услуг.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $services = Service::orderBy('sort', 'asc')->orderBy('id', 'desc')->get();
        return view('backend.services.index', compact('services'));
    }

    /**
     * Показывает форму для создания новой услуги.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.services.create');
    }

    /**
     * Сохраняет новую услугу в базе данных.
     *
     * @param ServiceRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ServiceRequest $request)
    {
        $data = $request->validated();

        if (empty($data['slug'])) {
            $titleForSlug = $data['title_en'] ?? $data['title_tj'] ?? $data['title_ru'] ?? 'service';
            $data['slug'] = \Str::slug($titleForSlug, '-');
        }

        Service::create([
            'title_ru' => $data['title_ru'] ?? null,
            'title_tj' => $data['title_tj'],
            'title_en' => $data['title_en'] ?? null,
            'slug' => $data['slug'],
            'icon' => $data['icon'] ?? null,
            'text_ru' => $data['text_ru'] ?? null,
            'text_tj' => $data['text_tj'],
            'text_en' => $data['text_en'] ?? null,
            'status' => $request->has('status') ? 1 : 0,
            'sort' => $data['sort'] ?? 0,
        ]);

        return redirect()->route('all.services')->with([
            'message' => 'Услуга успешно добавлена',
            'alert-type' => 'success'
        ]);
    }


    /**
     * Показывает форму для редактирования услуги.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('backend.services.edit', compact('service'));
    }

    /**
     * Обновляет информацию об услуге в базе данных.
     *
     * @param ServiceRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ServiceRequest $request)
    {
        $data = $request->validated();
        $service = Service::findOrFail($request->id);

        if (empty($data['slug'])) {
            $titleForSlug = $data['title_en'] ?? $data['title_tj'] ?? $data['title_ru'] ?? 'service';
            $data['slug'] = \Str::slug($titleForSlug, '-');
        }

        $service->update([
            'title_ru' => $data['title_ru'] ?? null,
            'title_tj' => $data['title_tj'],
            'title_en' => $data['title_en'] ?? null,
            'slug' => $data['slug'],
            'icon' => $data['icon'] ?? null,
            'text_ru' => $data['text_ru'] ?? null,
            'text_tj' => $data['text_tj'],
            'text_en' => $data['text_en'] ?? null,
            'status' => $request->has('status') ? 1 : 0,
            'sort' => $data['sort'] ?? 0,
        ]);

        return redirect()->route('all.services')->with([
            'message' => 'Услуга успешно обновлена',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Удаляет услугу из базы данных.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        $notification = array(
            'message' => 'Услуга успешно удалена',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}

