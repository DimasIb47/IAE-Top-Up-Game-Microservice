# Top Up Store Microservices

Project ini merupakan sistem Top Up Store yang dibangun menggunakan arsitektur Microservices, dengan 3 layanan utama:

- **User Service** (Port: 8001)
- **Game Service** (Port: 8002)
- **Transaction Service** (Port: 8003)

Setiap layanan memiliki API masing-masing dan berkomunikasi melalui HTTP Request (internal).

---

## Layanan & Endpoint

### User Service
User Service bertanggung jawab mengelola data pengguna di sistem Top Up Store.

#### API Endpoint
##### 1. `GET /api/users`
- **Deskripsi:** Mengambil semua data user.
- **Response:**
```json
[
  {
    "id": 1,
    "name": "John Doe",
    "email": "john@example.com",
    "phone_number": "081234567890",
    "created_at": "2024-05-01T00:00:00.000000Z",
    "updated_at": "2024-05-01T00:00:00.000000Z"
  },
]
```

##### 1. `GET /api/users`
- **Deskripsi:** Mengambil semua data user.
- **Response:**
```json
[
  {
    "id": 1,
    "name": "John Doe",
    "email": "john@example.com",
    "phone_number": "081234567890",
    "created_at": "2024-05-01T00:00:00.000000Z",
    "updated_at": "2024-05-01T00:00:00.000000Z"
  },
]
```

##### 2. `GET /api/users/{id}`

- **Deskripsi:** Mengambil detail user berdasarkan ID.
- **Response:**
```json
[
    {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com",
        "phone_number": "081234567890",
        "created_at": "2024-05-01T00:00:00.000000Z",
        "updated_at": "2024-05-01T00:00:00.000000Z"
    }
]
```

##### 3. `POST /api/users`
- **Deskripsi:** Menambah user baru.
- **Request Body:**
```json
[
    {
        "name": "Jane Doe",
        "email": "jane@example.com",
        "phone_number": "081987654321",
        "password": "password123"
    }
    ]
```
- **Response**
```json
    {
        "id": 2,
        "name": "Jane Doe",
        "email": "jane@example.com",
        "phone_number": "081987654321",
        "created_at": "2024-05-01T01:00:00.000000Z",
        "updated_at": "2024-05-01T01:00:00.000000Z"
    }
```

##### 3. `GET /api/users/{id}/transactions`
- **Deskripsi:** Mengambil daftar transaksi berdasarkan ID user. (Integrasi ke Transaction Service)

- **Response**
```json
    {
        "success": true,
        "user_id": 1,
        "name": "John Doe",
        "email": "john@example.com",
        "phone_number": "081234567890",
        "transactions": [
            {
            "id": 1001,
            "game_id": 5,
            "amount": 50000,
            "status": "Success",
            "created_at": "2024-05-01T02:00:00.000000Z"
            },
        ]
    }
```

### Game Service
Game Service bertanggung jawab mengelola data game, termasuk informasi top-up dan integrasi dengan Transaction Service.

---

#### 📚 API Endpoint

##### 1. `GET /api/games`
- **Deskripsi:** Mengambil semua data game.
- **Response:**
```json
[
  {
    "id": 1,
    "name": "Mobile Legends",
    "description": "MOBA 5v5 terbaik di dunia",
    "topup_options": ["Diamond 50", "Diamond 100", "Diamond 500"],
    "created_at": "2024-05-01T00:00:00.000000Z",
    "updated_at": "2024-05-01T00:00:00.000000Z"
  },
]
```

##### 2. `GET /api/games/{id}`
- **Deskripsi:** Mengambil detail game berdasarkan ID.
- **Response:**
```json
[
    {
        "id": 1,
        "name": "Mobile Legends",
        "description": "MOBA 5v5 terbaik di dunia",
        "topup_options": ["Diamond 50", "Diamond 100", "Diamond 500"],
        "created_at": "2024-05-01T00:00:00.000000Z",
        "updated_at": "2024-05-01T00:00:00.000000Z"
    }
]
```

##### 3. `POST /api/games`
- **Deskripsi:** Menambahkan game baru.
- **Response:**
```json
[
    {
        "name": "PUBG Mobile",
        "description": "Battle Royale Game",
        "topup_options": ["Diamond 50", "Diamond 100", "Diamond 500"]
    }
]
```

##### 4. `GET /api/games/{id}/transactions`
- **Deskripsi:**  Mengambil daftar transaksi berdasarkan ID game. (Integrasi ke Transaction Service)
- **Response:**
```json
[
    {
        "success": true,
        "game_id": 1,
        "game_name": "Mobile Legends",
        "description": "MOBA 5v5 terbaik di dunia",
        "topup_options": ["Diamond 50", "Diamond 100", "Diamond 500"],
        "transactions": [
            {
            "id": 5001,
            "user_id": 2,
            "topup_amount": 100,
            "status": "Success",
            "created_at": "2024-05-01T03:00:00.000000Z"
            },
        ]
    }
]
```

### Transaction Service
Transaction Service mengelola data transaksi yang dilakukan oleh pengguna dalam game. Ini mencakup menampilkan transaksi, menyimpan transaksi baru, serta menyediakan data transaksi terkait pengguna dan game.

---

#### API Endpoint

##### 1. `GET /api/transactions`
- **Deskripsi:** Mengambil semua data transaksi.
- **Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "user_id": 2,
      "game_id": 1,
      "game_user_id": "player_123",
      "topup_option": "Diamond 50",
      "price": 50000,
      "status": "pending",
      "created_at": "2024-05-01T00:00:00.000000Z",
      "updated_at": "2024-05-01T00:00:00.000000Z"
    }
  ]
}
```

##### 2. `GET /api/transactions/{id}`
- **Deskripsi:** Mengambil detail transaksi berdasarkan ID.
- **Response:**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "user_id": 2,
    "game_id": 1,
    "game_user_id": "player_123",
    "topup_option": "Diamond 50",
    "price": 50000,
    "status": "pending",
    "created_at": "2024-05-01T00:00:00.000000Z",
    "updated_at": "2024-05-01T00:00:00.000000Z"
  }
}
```
##### 3. `POST /api/transactions`
- **Deskripsi:** Menambahkan transaksi baru.
- **Request Body:**
```json
{
    {
        "user_id": 2,
        "game_id": 1,
        "game_user_id": "player_123",
        "topup_option": "Diamond 50",
        "price": 50000
    }
}
```
##### 4. `GET /api/transactions/user/{user_id}`
- **Deskripsi:** Mengambil semua transaksi berdasarkan user_id.
- **Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "user_id": 2,
      "game_id": 1,
      "game_user_id": "player_123",
      "topup_option": "Diamond 50",
      "price": 50000,
      "status": "pending",
      "created_at": "2024-05-01T00:00:00.000000Z",
      "updated_at": "2024-05-01T00:00:00.000000Z"
    },
  ]
}

```
##### 5. `GET /api/transactions/game/{game_id}`
- **Deskripsi:** Mengambil semua transaksi berdasarkan game_id.
- **Response:**
```json
{
    "success": true,
    "total_revenue": 150000,
    "transactions": [
        {
        "id": 1,
        "user_id": 2,
        "game_id": 1,
        "game_user_id": "player_123",
        "topup_option": "Diamond 50",
        "price": 50000,
        "status": "pending",
        "created_at": "2024-05-01T00:00:00.000000Z",
        "updated_at": "2024-05-01T00:00:00.000000Z"
        },
    ]
}
```

---

## Komunikasi Antar Service
Dalam arsitektur ini, masing-masing layanan berperan sebagai:

Provider: menyediakan data melalui API.
Consumer: mengonsumsi data dari layanan lain via API.

- Skema Umum:
```scss
User Service ⇄ Transaction Service ⇄ Game Service
        (Provider + Consumer)        (Provider + Consumer)
```
**User Service dan Game Service**
- Menjadi provider saat memberikan data user/game ke Transaction Service.
- Menjadi consumer saat mengambil data transaksi dari Transaction Service.

**Transaction Service**
- Menjadi consumer saat memvalidasi user dan game.
- Menjadi provider saat menyajikan data transaksi ke User Service dan Game Service.

### Implementasi Komunikasi

#### 1. Transaction Service sebagai Consumer

##### a. Konsumsi dari User Service (Verifikasi User saat Buat Transaksi)
```php
$userExists = Http::get('http://127.0.0.1:8001/api/users/' . $request->user_id)->successful();
```
Transaction Service memanggil User Service untuk memverifikasi keberadaan user_id saat membuat transaksi.

##### a. Konsumsi dari User Service (Verifikasi User saat Buat Transaksi)
```php
$userExists = Http::get('http://127.0.0.1:8001/api/users/' . $request->user_id)->successful();
```
Transaction Service memanggil User Service untuk memverifikasi keberadaan user_id saat membuat transaksi.

##### b. Konsumsi dari Game Service (Verifikasi Game saat Buat Transaksi)
```php
$gameExists = Http::get('http://127.0.0.1:8002/api/games/' . $request->game_id)->successful();
```
Transaction Service memanggil Game Service untuk memverifikasi keberadaan game_id saat membuat transaksi.

##### c. Konsumsi List Data untuk Formulir Create
```php
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
```
Saat mengakses halaman form, Transaction Service mengonsumsi API User Service dan Game Service untuk mengambil seluruh daftar user dan game.

#### 2. Transaction Service sebagai Provider

##### a. Menyediakan Data Transaksi Berdasarkan User
```php
    public function getUserTransactionAPI($id)
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

    public function getUserTransactions($id)
    {
        $user = User::findOrFail($id);
        
        try {
            $response = Http::get("http://127.0.0.1:8003/api/transactions/user/{$id}");
            
            if ($response->successful()) {
                return view('users.transactions', [
                    'user' => $user,
                    'transactions' => $response->json()['data'] ?? []
                ]);
            }
            
            return back()->with('error', 'Gagal mengambil data transaksi');

        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
```
User Service sebagai consumer dapat memanggil endpoint ini (http://127.0.0.1:8003/api/transactions/user/{$id}) untuk mendapatkan seluruh transaksi milik user tertentu

##### b. Menyediakan Data Transaksi dan Revenue Berdasarkan Game
```php
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
```
Game Service sebagai consumer dapat memanggil endpoint ini (http://127.0.0.1:8003/api/transactions/game/{$id}) untuk mendapatkan daftar transaksi yang berkaitan dengan game tertentu dan menghitung total revenue dari transaksi top-up game tersebut.

#### Diagram Komunikasi
```scss
  UserService (Provider) --> TransactionService (Consumer)
             ↖                                    ↘
              ↘                                 ↖
    TransactionService (Provider) --> GameService (Consumer)

```

---

## Instalasi

### Teknologi
- Laravel 10+
- PHP 8.1+
- MySQL
- RESTful API

```bash
git clone https://github.com/DimasIb47/IAE-Top-Up-Game-Microservice
```

Masuk ke folder utama dan buka terminal untuk masing-masing service

```bash
cd UserService & cd GameService & cd TransactionService
composer install
php artisan install:api
php artisan migrate -seed
php artisan serve --port=8001 & php artisan serve --port=8002 & php artisan serve --port=8003
```