<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Film;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->only('title', 'description', 'duration');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('films', 'public');
        }

        Film::create($data);

        return redirect()->route('admin.halls.index')->with('success', 'Фильм добавлен');
    }

    public function destroy(Film $film)
    {
        $film->delete();
        return redirect()->route('admin.halls.index')->with('success', 'Фильм удалён');
    }
}