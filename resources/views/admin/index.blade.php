<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Админ панель</title>
</head>
<body>
    <h1>Панель администратора</h1>

    @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif

    {{-- ЗАЛЫ --}}
    <h2>Залы</h2>
    <form method="POST" action="{{ route('admin.halls.store') }}">
        @csrf
        <input type="text" name="name" placeholder="Название зала" required>
        <input type="number" name="rows" placeholder="Рядов" min="1" required>
        <input type="number" name="seats_per_row" placeholder="Мест в ряду" min="1" required>
        <button type="submit">Добавить зал</button>
    </form>

    <table border="1" cellpadding="5">
        <tr>
            <th>ID</th><th>Название</th><th>Рядов</th><th>Мест в ряду</th><th>Открыт</th><th>Действия</th>
        </tr>
        @forelse($halls as $hall)
        <tr>
            <td>{{ $hall->id }}</td>
            <td>{{ $hall->name }}</td>
            <td>{{ $hall->rows }}</td>
            <td>{{ $hall->seats_per_row }}</td>
            <td>{{ $hall->is_open ? 'Да' : 'Нет' }}</td>
            <td>
                <form method="POST" action="{{ route('admin.halls.update', $hall) }}" style="display:inline">
                    @csrf @method('PUT')
                    <input type="checkbox" name="is_open" {{ $hall->is_open ? 'checked' : '' }}>
                    <button type="submit">Сохранить</button>
                </form>
                <form method="POST" action="{{ route('admin.halls.destroy', $hall) }}" style="display:inline">
                    @csrf @method('DELETE')
                    <button type="submit" onclick="return confirm('Удалить зал?')">Удалить</button>
                </form>
            </td>
        </tr>
        @empty
            <tr><td colspan="6">Нет залов</td></tr>
        @endforelse
    </table>

    {{-- ФИЛЬМЫ --}}
    <h2>Фильмы</h2>
    <form method="POST" action="{{ route('admin.films.store') }}" enctype="multipart/form-data">
        @csrf
        <input type="text" name="title" placeholder="Название фильма" required>
        <input type="text" name="duration" placeholder="Длительность (напр. 2ч 10м)" required>
        <textarea name="description" placeholder="Описание"></textarea>
        <input type="file" name="image" accept="image/*">
        <button type="submit">Добавить фильм</button>
    </form>

    <table border="1" cellpadding="5">
        <tr>
            <th>ID</th><th>Название</th><th>Длительность</th><th>Постер</th><th>Действия</th>
        </tr>
        @forelse($films as $film)
        <tr>
            <td>{{ $film->id }}</td>
            <td>{{ $film->title }}</td>
            <td>{{ $film->duration }}</td>
            <td>{{ $film->image ? 'Есть' : 'Нет' }}</td>
            <td>
                <form method="POST" action="{{ route('admin.films.destroy', $film) }}">
                    @csrf @method('DELETE')
                    <button type="submit" onclick="return confirm('Удалить фильм?')">Удалить</button>
                </form>
            </td>
        </tr>
        @empty
            <tr><td colspan="5">Нет фильмов</td></tr>
        @endforelse
    </table>

    {{-- СЕАНСЫ --}}
    <h2>Сеансы</h2>
    <form method="POST" action="{{ route('admin.seances.store') }}">
        @csrf
        <select name="hall_id" required>
            <option value="">Выберите зал</option>
            @foreach($halls as $hall)
                <option value="{{ $hall->id }}">{{ $hall->name }}</option>
            @endforeach
        </select>
        <select name="film_id" required>
            <option value="">Выберите фильм</option>
            @foreach($films as $film)
                <option value="{{ $film->id }}">{{ $film->title }}</option>
            @endforeach
        </select>
        <input type="date" name="date" required>
        <input type="time" name="start_time" required>
        <input type="number" name="price_standard" placeholder="Цена стандарт" min="0" step="0.01" required>
        <input type="number" name="price_vip" placeholder="Цена VIP" min="0" step="0.01" required>
        <button type="submit">Добавить сеанс</button>
    </form>

    <table border="1" cellpadding="5">
        <tr>
            <th>ID</th><th>Зал</th><th>Фильм</th><th>Дата</th><th>Время</th><th>Цена</th><th>Цена VIP</th><th>Действия</th>
        </tr>
        @forelse($seances as $seance)
        <tr>
            <td>{{ $seance->id }}</td>
            <td>{{ $seance->hall->name }}</td>
            <td>{{ $seance->film->title }}</td>
            <td>{{ $seance->date }}</td>
            <td>{{ $seance->start_time }}</td>
            <td>{{ $seance->price_standard }}</td>
            <td>{{ $seance->price_vip }}</td>
            <td>
                <form method="POST" action="{{ route('admin.seances.destroy', $seance) }}">
                    @csrf @method('DELETE')
                    <button type="submit" onclick="return confirm('Удалить сеанс?')">Удалить</button>
                </form>
            </td>
        </tr>
        @empty
            <tr><td colspan="8">Нет сеансов</td></tr>
        @endforelse
    </table>
</body>
</html>