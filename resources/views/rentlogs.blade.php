<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>e-rentBook | Rent Logs</title>

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

        .table td,

        .modal-title {
            font-weight: 600;
        }

        .modal-body h6 {
            font-weight: 600;
            margin-bottom: 10px;
        }

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
                    <li class="nav-item"><a class="nav-link" href="dashboard">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="books">Books</a></li>
                    <li class="nav-item"><a class="nav-link" href="categories">Categories</a></li>
                    <li class="nav-item"><a class="nav-link" href="users">Users</a></li>
                    <li class="nav-item"><a class="nav-link" href="book-rent">Book Rent</a></li>
                    <li class="nav-item"><a class="nav-link active" href="rent-logs">Rent Logs</a></li>
                    <li class="nav-item"><a class="nav-link text-danger" href="logout">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <h2 class="mb-4">Riwayat Peminjaman</h2>

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
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($rent_logs as $index => $log)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $log->username ?? 'N/A' }}</td>
                            <td>{{ $log->title ?? 'N/A' }}</td>
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
                            <td>
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#detailModal{{ $log->id }}">
                                    Detail
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data peminjaman.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Modal Detail -->
            @foreach ($rent_logs as $log)
                <div class="modal fade" id="detailModal{{ $log->id }}" tabindex="-1"
                    aria-labelledby="detailModalLabel{{ $log->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content shadow">
                            <div class="modal-header bg-dark text-white">
                                <h5 class="modal-title" id="detailModalLabel{{ $log->id }}">Detail Peminjaman</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row g-3">
                                    <!-- Identitas Peminjam -->
                                    <div class="col-md-6">
                                        <h6 class="text-secondary">📌 Identitas Peminjam</h6>
                                        <p><strong>Username:</strong> {{ $log->username }}</p>
                                        <p><strong>Email:</strong> {{ $log->email }}</p>
                                        <p><strong>Phone:</strong> {{ $log->phone }}</p>
                                        <p><strong>Address:</strong> {{ $log->address }}</p>
                                    </div>

                                    <!-- Detail Tanggal -->
                                    <div class="col-md-6">
                                        <h6 class="text-secondary">📅 Detail Tanggal</h6>
                                        <p><strong>Tanggal Pinjam:</strong> {{ $log->rent_date }}</p>
                                        <p><strong>Jatuh Tempo:</strong> {{ $log->return_date }}</p>
                                        <p><strong>Tanggal Kembali:</strong> {{ $log->actual_return_date ?? '-' }}</p>
                                    </div>

                                    <!-- Detail Buku -->
                                    <div class="col-md-6">
                                        <h6 class="text-secondary">📚 Detail Buku</h6>
                                        @if ($log->image)
                                            <img src="{{ $log->image }}" class="img-fluid rounded shadow mb-3"
                                                alt="Book Image">
                                        @endif
                                        <p><strong>Kode Buku:</strong> {{ $log->book_code }}</p>
                                        <p><strong>Judul:</strong> {{ $log->title }}</p>
                                        <p><strong>Penulis:</strong> {{ $log->author }}</p>
                                        <p><strong>Tahun:</strong> {{ $log->year }}</p>
                                        <p class="mt-2"><strong>Deskripsi:</strong> {{ $log->description }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
