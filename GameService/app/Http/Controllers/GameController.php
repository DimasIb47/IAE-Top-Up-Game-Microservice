<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function apiindex()
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

    public function getGameTransactionsAPI($id)
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

    public function index(Request $request)
    {
        $search = $request->query('search');
        
        $games = Game::when($search, function($query) use ($search) {
            return $query->where('name', 'like', "%{$search}%")
                        ->orWhere('id', 'like', "%{$search}");
        })->paginate(10);

        return view('games.index', compact('games', 'search'));
    }

    public function getGameTransactions($id)
    {
        $game = Game::findOrFail($id);
        
        try {
            $response = Http::get("http://127.0.0.1:8003/api/transactions/game/{$id}");
            
            if ($response->successful()) {
                $data = $response->json();
                $transactions = $data['transactions'];
                $total_revenue = $data['total_revenue'] ?? collect($transactions)->sum('topup_price');
                
                return view('games.transactions', compact('game', 'transactions', 'total_revenue'));
            }
            
            return back()->with('error', 'Gagal mengambil data transaksi');

        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    
}
