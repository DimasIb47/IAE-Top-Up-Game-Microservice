<?php
namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        return response()->json(Game::all());
    }

    public function show($id)
    {
        return response()->json(Game::findOrFail($id));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'topup_options' => 'required|array'
        ]);

        $game = Game::create($validated);

        return response()->json($game, 201);
    }
}
