<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Кинотеатр</title>
</head>
<body>
    <h1>Расписание сеансов</h1>

    @forelse($halls as $hall)
        <h2>{{ $hall->name }}</h2>
        @forelse($hall->seances as $seance)
            <div>
                <strong>{{ $seance->film->title }}</strong>
                {{ $seance->date }} {{ $seance->start_time }}
                <a href="{{ route('hall.show', $seance) }}">Выбрать место</a>
            </div>
        @empty
            <p>Нет сеансов</p>
        @endforelse
    @empty
        <p>Нет открытых залов</p>
    @endforelse
</body>
</html>