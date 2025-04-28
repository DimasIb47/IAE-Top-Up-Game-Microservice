<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Game;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TransactionController extends Controller
{
    /**
     * Menampilkan semua transaksi (GET /transactions)
     */
    public function index()
    {
        $transactions = Transaction::all();
        
        return response()->json([
            'success' => true,
            'data' => $transactions
        ], 200);
    }

     /**
     * Menampilkan detail transaksi (GET /transactions/{id})
     */
    public function show($id)
    {
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Transaksi tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $transaction
        ], 200);
    }

    public function create()
    {
        try {
            $usersResponse = Http::get('http://127.0.0.1:8001/api/users');
            $gamesResponse = Http::get('http://127.0.0.1:8002/api/games');

            // Convert responses to arrays
            $users = $usersResponse->successful() ? json_decode($usersResponse->body(), true) : [];
            $games = $gamesResponse->successful() ? json_decode($gamesResponse->body(), true) : [];

            return view('create', [
                'users' => $users,
                'games' => $games
            ]);
        } catch (\Exception $e) {
            \Log::error('Error fetching data: ' . $e->getMessage());
            return view('create', [
                'users' => [],
                'games' => []
            ]);
        }
    }

    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'user_id' => 'required|numeric',
            'game_id' => 'required|numeric',
            'game_user_id' => 'required|string',
            'topup_option' => 'required|string',
            'price' => 'required|numeric'
        ]);

        try {
            // Verify user and game exist
            $userExists = Http::get('http://127.0.0.1:8001/api/users/' . $request->user_id)->successful();
            $gameExists = Http::get('http://127.0.0.1:8002/api/games/' . $request->game_id)->successful();

            if (!$userExists) {
                return back()->withErrors(['user_id' => 'User not found'])->withInput();
            }

            if (!$gameExists) {
                return back()->withErrors(['game_id' => 'Game not found'])->withInput();
            }

            // Save transaction
            $transaction = new Transaction();
            $transaction->user_id = $request->user_id;
            $transaction->game_id = $request->game_id;
            $transaction->game_user_id = $request->game_user_id;
            $transaction->topup_option = $request->topup_option;
            $transaction->price = $request->price;
            $transaction->status = 'pending';
            $transaction->save();

            // Redirect ke halaman sukses
            return redirect()->route('transactions.success');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }

    public function history(Request $request)
    {
        $query = Transaction::query();

        if ($request->sort == 'price') {
            $query->orderBy('price', 'asc');
        } elseif ($request->sort == 'price_desc') {
            $query->orderBy('price', 'desc');
        } elseif ($request->sort == 'latest') {
            $query->orderBy('created_at', 'desc');
        } elseif ($request->sort == 'oldest') {
            $query->orderBy('created_at', 'asc');
        } else {
            $query->orderBy('created_at', 'desc'); // default
        }

        $transactions = $query->get();

        return view('transactions.history', compact('transactions'));
    }

    // Tambahan: halaman sukses
    public function success()
    {
        return view('transactions.success');
    }

        /**
     * Get all transactions by user_id (untuk UserService)
     */
    public function getUserTransactions($user_id)
    {
        $transactions = Transaction::where('user_id', $user_id)->get();
        
        return response()->json([
            'success' => true,
            'data' => $transactions
        ]);
    }

    /**
     * Get all transactions by game_id (untuk GameService)
     */
    public function getGameTransactions($game_id)
    {
        $transactions = Transaction::where('game_id', $game_id)->get();
        $totalRevenue = $transactions->sum('price');
        
        return response()->json([
            'success' => true,
            'total_revenue' => $totalRevenue,
            'transactions' => $transactions
        ]);
}
    
}
