<!DOCTYPE html>
<html>
<head>
    <title>Daftar User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { padding: 20px; }
        .search-box { margin-bottom: 20px; }
        .table { margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mb-4">Daftar User</h1>
        
        <div class="search-box">
            <form action="{{ url('/users') }}" method="GET" class="row g-3">
                <div class="col-md-8">
                    <input type="text" name="search" class="form-control" placeholder="Cari nama/email..." value="{{ request('search') }}">
                </div>
                <div class="col-md-4">
                    <button class="btn btn-primary w-100" type="submit">Search</button>
                </div>
            </form>
        </div>

        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone_number }}</td>
                    <td>
                        <a href="{{ url('/users/'.$user->id.'/transactions') }}" class="btn btn-sm btn-info">
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