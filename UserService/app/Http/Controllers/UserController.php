<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Sanctum\HasApiTokens;

class UserController extends Controller
{
    public function index()
    {
        return response()->json(User::all());
    }

    public function show($id)
    {
        return response()->json(User::findOrFail($id));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'phone_number' => 'required|string',
            'password' => 'required|string|min:8',
        ]);

        $validated['password'] = bcrypt($validated['password']);
        $user = User::create($validated);

        return response()->json($user, 201);
    }

    public function getUserTransactionHistory($id)
    {
        // Ambil data user dari database
        $user = User::find($id);
        
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan'
            ], 404);
        }
    
        // Panggil TransactionService
        $response = Http::get("http://127.0.0.1:8003/api/transactions/user/{$id}");
        
        if ($response->successful()) {
            return response()->json([
                'success' => true,
                'user_id' => $id,
                'name' => $user->name,
                'email' => $user->email,
                'phone_number' => $user->phone_number,
                'transactions' => $response->json()['data']
            ]);
        }
        
        return response()->json([
            'success' => false,
            'message' => 'Gagal mengambil history transaksi'
        ], 500);
    }


}
