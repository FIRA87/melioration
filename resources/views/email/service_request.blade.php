<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Новая заявка на услугу</title>
</head>
<body style="font-family: Arial, sans-serif;">
<h2>Новая заявка на услугу</h2>

<p><strong>ФИО:</strong> {{ $request->fio }}</p>
<p><strong>Телефон:</strong> {{ $request->phone }}</p>
<p><strong>Услуга:</strong> {{ $request->service->title_tj ?? '—' }}</p>
@if($request->comment)
    <p><strong>Комментарий:</strong> {{ $request->comment }}</p>
@endif

<p>Дата: {{ $request->created_at->format('d.m.Y H:i') }}</p>
</body>
</html>
