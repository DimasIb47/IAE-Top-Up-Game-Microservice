<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; padding: 20px; }
        .container { max-width: 1000px; margin: 0 auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 0 15px rgba(0,0,0,0.1); }
        h2 { color: #0d6efd; margin-bottom: 25px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Riwayat Transaksi</h2>

        <!-- Form Sorting -->
        <form method="GET" action="{{ route('transactions.history') }}" class="row mb-4">
            <div class="col-md-6">
                <select name="sort" class="form-select" onchange="this.form.submit()">
                    <option value="">Urutkan berdasarkan</option>
                    <option value="price" {{ request('sort') == 'price' ? 'selected' : '' }}>Harga (Terendah - Tertinggi)</option>
                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Harga (Tertinggi - Terendah)</option>
                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Tanggal Terbaru</option>
                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Tanggal Terlama</option>
                </select>
            </div>
        </form>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>User ID</th>
                    <th>Game ID</th>
                    <th>Game User ID</th>
                    <th>Top-up</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->id }}</td>
                        <td>{{ $transaction->user_id }}</td>
                        <td>{{ $transaction->game_id }}</td>
                        <td>{{ $transaction->game_user_id }}</td>
                        <td>{{ $transaction->topup_option }}</td>
                        <td>Rp {{ number_format($transaction->price, 0, ',', '.') }}</td>
                        <td>
                            @if ($transaction->status == 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                            @elseif ($transaction->status == 'success')
                                <span class="badge bg-success">Sukses</span>
                            @elseif ($transaction->status == 'failed')
                                <span class="badge bg-danger">Gagal</span>
                            @else
                                <span class="badge bg-secondary">{{ ucfirst($transaction->status) }}</span>
                            @endif
                        </td>
                        <td>{{ $transaction->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">Belum ada transaksi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-3">
            <a href="{{ route('transactions.create') }}" class="btn btn-primary">Input Transaksi Baru</a>
        </div>
    </div>
</body>
</html>
