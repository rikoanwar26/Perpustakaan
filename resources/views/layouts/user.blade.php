<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Perpustakaan Digital</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/user">📚 Perpustakaan</a>

        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a href="/user" class="nav-link">Buku</a>
                </li>
                <li class="nav-item">
                    <a href="/riwayat" class="nav-link">Riwayat</a>
                </li>
                <li class="nav-item">
                    <a href="/logout" class="nav-link text-danger">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<main>
    @yield('content')
</main>

</body>
</html>
