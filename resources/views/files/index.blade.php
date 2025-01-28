<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список файлов</title>
</head>
<body>
<h1>Список файлов для скачивания</h1>
@if (empty($files))
    <p>Нет доступных файлов.</p>
@else
    <ul>
        @foreach ($files as $file)
            <li>
                <a href="{{ route('download', ['filename' => $file]) }}">{{ $file }}</a>
            </li>
        @endforeach
    </ul>
@endif
</body>
</html>
