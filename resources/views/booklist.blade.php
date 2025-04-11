<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>e-rentBook | Daftar Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: gainsboro;
        }

        .card:hover {
            transform: scale(1.02);
            transition: 0.3s ease-in-out;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        }

        .card-img-top {
            height: 250px;
            object-fit: cover;
            padding: 10px
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }

        .badge-status {
            position: absolute;
            bottom: 0;
            right: 0;
            margin: 10px;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
        <div class="container">
            <a class="navbar-brand" href="#">📚 e-rentBook</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile') }}">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('booklist.index') }}">Daftar Buku</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn-danger" href="{{ route('logout') }}">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <h2 class="mb-4">Daftar Buku</h2>

        <!-- Search Bar -->
        <form method="GET" action="{{ route('booklist.search') }}" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari judul buku..."
                    value="{{ request('search') }}">
                <button class="btn btn-outline-primary" type="submit">Cari</button>
            </div>
        </form>

        <!-- Grid Buku -->
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            @forelse ($books as $book)
                <div class="col">
                    <div class="card h-100 shadow-sm border-0 position-relative" style="cursor: pointer;"
                        data-bs-toggle="modal" data-bs-target="#detailModal{{ $book->id }}">
                        <img src="{{ $book->image ?? 'https://via.placeholder.com/300x400?text=No+Image' }}"
                            class="card-img-top" alt="{{ $book->title }}">
                        <div class="card-body">
                            <h5 class="card-title mb-1">{{ $book->title }}</h5>
                            <p class="card-text text-muted mb-0">{{ $book->author }}</p>
                        </div>
                        <span
                            class="badge bg-{{ $book->status === 'available' ? 'success' : 'secondary' }} badge-status">
                            {{ ucfirst($book->status) }}
                        </span>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">Tidak ada buku tersedia.</div>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Modal Detail Buku -->
    @foreach ($books as $book)
        <div class="modal fade" id="detailModal{{ $book->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detail Buku</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body row">
                        <div class="col-md-5">
                            @if ($book->image)
                                <img src="{{ $book->image }}" class="img-fluid rounded">
                            @else
                                <div class="text-muted">Tidak ada gambar</div>
                            @endif
                        </div>
                        <div class="col-md-7">
                            <p><strong>Kode:</strong> {{ $book->book_code }}</p>
                            <p><strong>Judul:</strong> {{ $book->title }}</p>
                            <p><strong>Penulis:</strong> {{ $book->author }}</p>
                            <p><strong>Tahun:</strong> {{ $book->year }}</p>
                            <p><strong>Kategori:</strong>
                                @foreach ($book->categories as $cat)
                                    <span class="badge bg-primary">{{ $cat->name }}</span>
                                @endforeach
                            </p>
                            <p><strong>Deskripsi:</strong><br>{{ $book->description }}</p>
                            <p><strong>Status:</strong> {{ ucfirst($book->status) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
