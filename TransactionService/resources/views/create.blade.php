<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top-up Transaction</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 0 15px rgba(0,0,0,0.1); }
        h2 { color: #0d6efd; margin-bottom: 25px; text-align: center; }
        .btn-primary { width: 100%; padding: 10px; margin-top: 15px; }
        .form-group { margin-bottom: 20px; }
        .price-badge { background: #0d6efd; color: white; padding: 3px 8px; border-radius: 10px; font-size: 0.8em; margin-left: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Input Transaksi Top-up</h2>
        
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        <form action="{{ route('transactions.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="user_id" class="form-label">Pilih User</label>
                <select class="form-select" id="user_id" name="user_id" required>
                    <option value="">Pilih User</option>
                    @foreach ($users ?? [] as $user)
                        <option value="{{ $user['id'] }}">{{ $user['name'] }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="game_id" class="form-label">Pilih Game</label>
                <select class="form-select" id="game_id" name="game_id" required>
                    <option value="">Pilih Game</option>
                    @foreach ($games ?? [] as $game)
                        <option value="{{ $game['id'] }}" data-options="{{ json_encode($game['topup_options']) }}">
                            {{ $game['name'] }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="game_user_id" class="form-label">Game User ID</label>
                <input type="text" class="form-control" id="game_user_id" name="game_user_id" required placeholder="Masukkan ID User di Game">
            </div>

            <div class="form-group">
                <label for="topup_option" class="form-label">Pilih Paket Top-up</label>
                <select class="form-select" id="topup_option" name="topup_option" required>
                    <option value="">Pilih Paket</option>
                    <!-- Options will be populated by JavaScript -->
                </select>
                <input type="hidden" id="price" name="price">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('game_id').addEventListener('change', function() {
            const gameSelect = this;
            const topupSelect = document.getElementById('topup_option');
            const options = JSON.parse(gameSelect.options[gameSelect.selectedIndex].dataset.options);
            
            // Clear existing options
            topupSelect.innerHTML = '<option value="">Pilih Paket</option>';
            
            // Add new options with prices
            options.forEach(option => {
                const opt = document.createElement('option');
                opt.value = option.option;
                opt.textContent = `${option.option} (Rp ${option.price.toLocaleString()})`;
                opt.dataset.price = option.price;
                topupSelect.appendChild(opt);
            });
        });

        // Update hidden price field when selection changes
        document.getElementById('topup_option').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            document.getElementById('price').value = selectedOption.dataset.price || '';
        });
    </script>
</body>
</html>