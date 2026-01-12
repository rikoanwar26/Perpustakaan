<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login | Perpustakaan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(120deg, #1e3c72, #2a5298);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            border-radius: 15px;
        }
    </style>
</head>
<body>

<div class="card shadow p-4" style="width: 380px;">
    <h4 class="text-center fw-bold mb-3">Login Perpustakaan</h4>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="/login" method="POST">
        @csrf

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button class="btn btn-primary w-100">
            Login
        </button>
    </form>

    <div class="text-center mt-3">
        <small>
            Belum punya akun?
            <a href="{{ route('register') }}">Daftar Sekarang</a>
        </small>
    </div>

    <div class="text-center mt-2">
        <a href="/" class="text-decoration-none">← Kembali ke Beranda</a>
    </div>
</div>

</body>
</html>
