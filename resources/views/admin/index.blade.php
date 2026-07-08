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
            <th>ID</th>
            <th>Название</th>
            <th>Рядов</th>
            <th>Мест в ряду</th>
            <th>Открыт</th>
            <th>Действия</th>
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
                    <button type="submit" onclick="return confirm('Удалить?')">Удалить</button>
                </form>
            </td>
        </tr>
        @empty
            <tr><td colspan="6">Нет залов</td></tr>
        @endforelse
    </table>
</body>
</html>