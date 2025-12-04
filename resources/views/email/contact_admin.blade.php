<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Document</title>
</head>
<body>

<p>Новое обращение с сайта:</p>

<table border="1" cellpadding="10" cellspacing="0" style="border-collapse: collapse;">
    <tr><th>Имя</th><td>{{ $request->name }}</td></tr>
    <tr><th>Телефон</th><td>{{ $request->phone }}</td></tr>
    <tr><th>Email</th><td>{{ $request->email }}</td></tr>
    <tr><th>Сообщение</th><td>{{ nl2br(e($request->message)) }}</td></tr>
    <tr><th>Дата</th><td>{{ now()->format('d.m.Y H:i') }}</td></tr>
</table>

<p><a href="{{ url('/admin/contacts/' . $contact->id) }}">Перейти в админку к сообщению →</a></p>
</body>
</html>