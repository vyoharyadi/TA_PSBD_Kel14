<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>e-rentBook | Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        .navbar-brand {
            font-weight: 600;
        }

        .card h3 {
            font-size: 2rem;
        }

        .table td,
        .table th {
            vertical-align: middle;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">📚 e-rentBook</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarAdmin">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarAdmin">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link active" href="dashboard">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="books">Books</a></li>
                    <li class="nav-item"><a class="nav-link" href="categories">Categories</a></li>
                    <li class="nav-item"><a class="nav-link" href="users">Users</a></li>
                    <li class="nav-item"><a class="nav-link" href="book-rent">Book Rent</a></li>
                    <li class="nav-item"><a class="nav-link" href="rent-logs">Rent Logs</a></li>
                    <li class="nav-item"><a class="nav-link text-danger" href="logout">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Dashboard Content -->
    <div class="container my-5">
        <h2 class="mb-4">Dashboard Admin</h2>

        <!-- Cards -->
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="card bg-primary text-white shadow h-100">
                    <div class="card-body">
                        <h5>Jumlah Pengguna Aktif</h5>
                        <h3>{{ $user_count }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-success text-white shadow h-100">
                    <div class="card-body">
                        <h5>Jumlah Kategori</h5>
                        <h3>{{ $category_count }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-warning text-dark shadow h-100">
                    <div class="card-body">
                        <h5>Jumlah Buku</h5>
                        <h3>{{ $book_count }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rent Logs Table -->
        <h4 class="mb-3">Log Peminjaman Terbaru</h4>
        <div class="table-responsive">
            <table class="table table-bordered table-hover bg-white">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Nama User</th>
                        <th>Judul Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Jatuh Tempo</th>
                        <th>Tanggal Kembali</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($rent_logs as $index => $log)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $log->user->username ?? 'N/A' }}</td>
                            <td>{{ $log->book->title ?? 'N/A' }}</td>
                            <td>{{ $log->rent_date }}</td>
                            <td>{{ $log->return_date }}</td>
                            <td>{{ $log->actual_return_date ?? '-' }}</td>
                            <td>
                                @php
                                    $status = strtolower($log->status);
                                    $badgeClass =
                                        $status === 'returned'
                                            ? 'bg-success'
                                            : ($status === 'on rent'
                                                ? 'bg-danger'
                                                : 'bg-secondary');
                                @endphp
                                <span class="badge {{ $badgeClass }}">
                                    {{ ucfirst($log->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data peminjaman.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
