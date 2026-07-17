<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Seance;
use App\Models\Hall;
use App\Models\Film;
use Illuminate\Http\Request;

class SeanceController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'hall_id' => 'required|exists:halls,id',
            'film_id' => 'required|exists:films,id',
            'date' => 'required|date',
            'start_time' => 'required',
            'price_standard' => 'required|numeric|min:0',
            'price_vip' => 'required|numeric|min:0',
        ]);

        Seance::create($request->all());

        return redirect()->route('admin.halls.index')->with('success', 'Сеанс добавлен');
    }

    public function destroy(Seance $seance)
    {
        $seance->delete();
        return redirect()->route('admin.halls.index')->with('success', 'Сеанс удалён');
    }
}