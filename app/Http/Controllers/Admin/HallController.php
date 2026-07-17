<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hall;
use App\Models\Seat;
use Illuminate\Http\Request;

class HallController extends Controller
{
    public function index()
    {
        $halls = Hall::all();
        $films = \App\Models\Film::all();
        $seances = \App\Models\Seance::with(['hall', 'film'])->get();
        return view('admin.index', compact('halls', 'films', 'seances'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'rows' => 'required|integer|min:1',
            'seats_per_row' => 'required|integer|min:1',
        ]);

        $hall = Hall::create($request->only('name', 'rows', 'seats_per_row'));

        for ($row = 1; $row <= $hall->rows; $row++) {
            for ($seat = 1; $seat <= $hall->seats_per_row; $seat++) {
                Seat::create([
                    'hall_id' => $hall->id,
                    'row' => $row,
                    'seat_number' => $seat,
                    'type' => 'standard',
                ]);
            }
        }

        return redirect()->route('admin.halls.index')->with('success', 'Зал создан');
    }

    public function update(Request $request, Hall $hall)
    {
        $hall->update(['is_open' => $request->has('is_open')]);
        return redirect()->route('admin.halls.index')->with('success', 'Зал обновлён');
    }

    public function destroy(Hall $hall)
    {
        $hall->delete();
        return redirect()->route('admin.halls.index')->with('success', 'Зал удалён');
    }
}