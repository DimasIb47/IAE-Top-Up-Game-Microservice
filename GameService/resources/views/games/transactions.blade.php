<!DOCTYPE html>
<html>
<head>
    <title>Transaksi Game</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { padding: 20px; }
        .game-card { margin-bottom: 30px; }
        .back-btn { margin-bottom: 20px; }
        .revenue { font-size: 1.2em; color: #28a745; }
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ url('/games') }}" class="btn btn-secondary back-btn">Kembali</a>
        <h1 class="mb-4">Transaksi Game: {{ $game->name }}</h1>

        <div class="card game-card">
            <div class="card-header bg-primary text-white">
                <h5>Statistik Game</h5>
            </div>
            <div class="card-body">
                <p><strong>Deskripsi:</strong> {{ $game->description }}</p>
                <p class="revenue"><strong>Total Revenue:</strong> Rp {{ number_format($total_revenue, 0, ',', '.') }}</p>
            </div>
        </div>

        <h3 class="mt-4">Daftar Transaksi</h3>
        <table class="table table-striped mt-3">
            <thead class="table-dark">
                <tr>
                    <th>ID Transaksi</th>
                    <th>ID User</th>
                    <th>Item</th>
                    <th>Harga</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $transaction)
                <tr>
                    <td>{{ $transaction['id'] }}</td>
                    <td>{{ $transaction['user_id'] }}</td>
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