<!DOCTYPE html>
<html>
<head>
    <title>Transaksi User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { padding: 20px; }
        .user-card { margin-bottom: 30px; }
        .back-btn { margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ url('/users') }}" class="btn btn-secondary back-btn">Kembali</a>
        <h1 class="mb-4">Transaksi User: {{ $user->name }}</h1>

        <div class="card user-card">
            <div class="card-header bg-primary text-white">
                <h5>Informasi User</h5>
            </div>
            <div class="card-body">
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Phone:</strong> {{ $user->phone_number }}</p>
            </div>
        </div>

        <h3 class="mt-4">Riwayat Transaksi</h3>
        <table class="table table-striped mt-3">
            <thead class="table-dark">
                <tr>
                    <th>ID Transaksi</th>
                    <th>Game</th>
                    <th>Game User ID</th>
                    <th>Item</th>
                    <th>Harga</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $transaction)
                <tr>
                    <td>{{ $transaction['id'] }}</td>
                    <td>{{ $transaction['game_id'] }}</td>
                    <td>{{ $transaction['game_user_id'] }}</td>
                    <td>{{ $transaction['topup_option'] }}</td>
                    <td>Rp {{ number_format($transaction['price'], 0, ',', '.') }}</td>
                    <td>
                        <span class="badge bg-{{ $transaction['status'] == 'completed' ? 'success' : 'warning' }}">
                            {{ $transaction['status'] }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>