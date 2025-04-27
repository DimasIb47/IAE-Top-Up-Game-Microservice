<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Game;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TransactionController extends Controller
{

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
            // Verify user exists
            $userExists = Http::get('http://127.0.0.1:8001/api/users/'.$request->user_id)->successful();
            $gameExists = Http::get('http://127.0.0.1:8002/api/games/'.$request->game_id)->successful();
    
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
    
            return redirect()->route('home')->with('success', 'Transaksi berhasil');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan: '.$e->getMessage()])->withInput();
        }
    }
}