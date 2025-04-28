<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
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

    public function getGameTransactions($id)
    {
        // Ambil data game dari database
        $game = Game::find($id);
        
        if (!$game) {
            return response()->json([
                'success' => false,
                'message' => 'Game tidak ditemukan'
            ], 404);
        }
    
        // Panggil TransactionService
        $response = Http::get("http://127.0.0.1:8003/api/transactions/game/{$id}");
        
        if ($response->successful()) {
            $transactions = $response->json();
            
            return response()->json([
                'success' => true,
                'game_id' => $id,
                'game_name' => $game->name,
                'description' => $game->description,
                'topup_options' => $game->topup_options,
                'transactions' => $transactions
                
            ]);
        }
        
        return response()->json([
            'success' => false,
            'message' => 'Gagal mengambil transaksi game'
        ], 500);
    }
}
