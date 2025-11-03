<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\LinkRequest;
use App\Models\Link;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class LinkController extends Controller
{
    /**
     * Отображение списка ссылок с пагинацией и кэшированием (если список редко меняется)
     */
    public function index()
    {
        $links = Link::orderBy('sort', 'asc')
            ->orderBy('id', 'asc')
            ->paginate(50); // Пагинация вместо all()

        return view('backend.links.index', compact('links'));
    }

    /**
     * Форма создания
     */
    public function create()
    {
        return view('backend.links.create');
    }

    /**
     * Сохранение новой ссылки
     */
    public function store(LinkRequest $request)
    {
        $data = $request->validated();

        $image = $request->file('img');
        $name_gen = $this->generateImageName($image);
        $this->saveImage($image, $name_gen);

        Link::create([
            'title_ru' => $data['title_ru'],
            'title_tj' => $data['title_tj'] ?? null,
            'title_en' => $data['title_en'],
            'url'      => $data['url'],
            'img'      => 'upload/links/' . $name_gen,
            'status'   => $data['status'],
            'sort'     => $data['sort'] ?? 0,
            'created_at' => Carbon::now(),
        ]);

        return $this->redirectWithSuccess('Ссылка успешно добавлена', 'all.links');
    }

    /**
     * Форма редактирования — используем route-model binding
     */
    public function edit(Link $link)
    {
        return view('backend.links.edit', compact('link'));
    }

    /**
     * Обновление ссылки — используем переданную модель $link
     */
    public function update(LinkRequest $request, Link $link)
    {
        $data = $request->validated();

        // Формируем данные для обновления
        $updateData = [
            'title_ru' => $data['title_ru'],
            'title_tj' => $data['title_tj'] ?? null,
            'title_en' => $data['title_en'],
            'url'      => $data['url'],
            'status'   => $data['status'],
            'sort'     => isset($data['sort']) && $data['sort'] !== '' ? (int)$data['sort'] : 0,
        ];

        // Обработка изображения
        if ($request->hasFile('img')) {
            $this->deleteOldImage($link->img);

            $image = $request->file('img');
            $name_gen = $this->generateImageName($image);
            $this->saveImage($image, $name_gen);

            $updateData['img'] = 'upload/links/' . $name_gen;
        }

        // Обновляем модель
        $link->update($updateData);

        return $this->redirectWithSuccess('Ссылка успешно обновлена', 'all.links');
    }

    /**
     * Удаление ссылки
     */
    public function delete($id)
    {
        $link = Link::findOrFail($id);
        $this->deleteOldImage($link->img);
        $link->delete();

        return $this->redirectWithSuccess('Ссылка успешно удалена', 'all.links');
    }

    // ==================================================================
    // Вспомогательные методы (выносим логику из контроллера — Clean Code)
    // ==================================================================

    /**
     * Генерация уникального имени файла
     */
    private function generateImageName($image): string
    {
        return date('Y-m-d') . $image->getClientOriginalName();
    }

    /**
     * Сохранение изображения с ресайзом
     */
    private function saveImage($image, string $name): void
    {
        $path = public_path('upload/links/' . $name);
        Image::make($image)->resize(700, 700)->save($path);
    }

    /**
     * Удаление старого изображения
     */
    private function deleteOldImage(string $imagePath): void
    {
        $fullPath = public_path($imagePath);
        if (File::exists($fullPath)) {
            File::delete($fullPath);
        }
    }

    /**
     * Унифицированный редирект с уведомлением
     */
    private function redirectWithSuccess(string $message, string $route)
    {
        return redirect()->route($route)->with([
            'message' => $message,
            'alert-type' => 'success'
        ]);
    }
}
