<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Petugas Perpustakaan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f1f5f9;
        }
        .sidebar {
            width: 260px;
            height: 100vh;
            background-color: #0f172a;
            position: fixed;
            color: white;
        }
        .sidebar h5 {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid #334155;
        }
        .sidebar a {
            display: block;
            padding: 12px 20px;
            color: #cbd5f5;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #1e293b;
            color: white;
        }
        .content {
            margin-left: 260px;
            padding: 25px;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <h5>👨‍💼 Petugas</h5>
    
        <a href="/petugas">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>
    
        <a href="/petugas/buku">
            <i class="bi bi-book"></i> Data Buku
        </a>
    
        <a href="/petugas/kategori">
            <i class="bi bi-tags"></i> Kategori
        </a>
    
        <a href="/petugas/penulis">
            <i class="bi bi-person-lines-fill"></i> Penulis
        </a>
    
        <a href="/petugas/transaksi">
            <i class="bi bi-arrow-repeat"></i> Transaksi
        </a>
    
        <a href="/logout" class="text-danger">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
    </div>
    

<div class="content">
    @yield('content')
</div>

</body>
</html>