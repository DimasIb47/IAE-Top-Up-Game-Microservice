<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Berhasil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 0 15px rgba(0,0,0,0.1); text-align: center; }
        h2 { color: #198754; margin-bottom: 20px; }
        .btn { margin: 10px; width: 200px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Transaksi Berhasil!</h2>
        <p>Terima kasih, transaksi top-up Anda sudah berhasil disimpan.</p>

        <div class="d-flex flex-column align-items-center">
            <a href="{{ route('transactions.create') }}" class="btn btn-primary">Kembali ke Input</a>
            <a href="{{ route('transactions.history') }}" class="btn btn-success">Lihat Riwayat</a>
        </div>
    </div>
</body>
</html>
