<!DOCTYPE html>
<html>
<head>
    <title>Daftar Game</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { padding: 20px; }
        .search-box { margin-bottom: 20px; }
        .revenue { font-weight: bold; color: #28a745; }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mb-4">Daftar Game</h1>
        
        <div class="search-box">
            <form action="{{ url('/games') }}" method="GET" class="row g-3">
                <div class="col-md-8">
                    <input type="text" name="search" class="form-control" placeholder="Cari nama game..." value="{{ request('search') }}">
                </div>
                <div class="col-md-4">
                    <button class="btn btn-primary w-100" type="submit">Search</button>
                </div>
            </form>
        </div>

        <table class="table table-striped mt-4">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama Game</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($games as $game)
                <tr>
                    <td>{{ $game->id }}</td>
                    <td>{{ $game->name }}</td>
                    <td>{{ Str::limit($game->description, 50) }}</td>
                    <td>
                        <a href="{{ url('/games/'.$game->id.'/transactions') }}" class="btn btn-sm btn-info">
                            Transaksi
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>