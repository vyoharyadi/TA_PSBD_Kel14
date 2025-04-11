<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>e-rentBook | Book List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <!-- Di bagian -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        .navbar-brand {
            font-weight: 600;
        }

        .table td,
        .table th {
            vertical-align: middle;
        }

        img.cover-img {
            width: 100%;
            border-radius: 8px;
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
                    <li class="nav-item"><a class="nav-link active" href="books">Books</a></li>
                    <li class="nav-item"><a class="nav-link" href="categories">Categories</a></li>
                    <li class="nav-item"><a class="nav-link" href="users">Users</a></li>
                    <li class="nav-item"><a class="nav-link" href="book-rent">Book Rent</a></li>
                    <li class="nav-item"><a class="nav-link" href="rent-logs">Rent Logs</a></li>
                    <li class="nav-item"><a class="nav-link text-danger" href="logout">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <h2 class="mb-4">Daftar Buku</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Buttons -->
        <div class="mb-3">
            <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#addBookModal">+ Add
                Books</button>
            <a href="{{ route('books.index') }}" class="btn btn-success me-2">Book Lists</a>
            <a href="{{ route('books.deleted') }}" class="btn btn-danger">Deleted Books</a>
        </div>

        <!-- Table Books -->
        <div class="table-responsive">
            <table class="table table-bordered bg-white table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Code</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Status</th>
                        <th style="width: 240px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($books as $index => $book)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $book->book_code }}</td>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author }}</td>
                            <td>{{ ucfirst($book->status) }}</td>
                            <td>
                                <button class="btn btn-info btn-sm me-1 my-1" data-bs-toggle="modal"
                                    data-bs-target="#detailModal{{ $book->id }}">Detail</button>

                                @if ($book->status === 'deleted')
                                    <form action="{{ route('books.restore', $book->id) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Yakin ingin me-restore buku ini?')">
                                        @csrf
                                        @method('PATCH')
                                        <button class="btn btn-success btn-sm me-1 my-1">Restore</button>
                                    </form>

                                    <form action="{{ route('books.forceDelete', $book->id) }}" method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Yakin ingin menghapus permanen buku ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Delete Permanen</button>
                                    </form>
                                @else
                                    <button class="btn btn-warning btn-sm me-1" data-bs-toggle="modal"
                                        data-bs-target="#editModal{{ $book->id }}">Edit</button>

                                    <form action="{{ route('books.delete', $book->id) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                                        @csrf
                                        @method('PATCH')
                                        <button class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                @endif
                            </td>

                        </tr>

                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada buku tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Tambah Buku -->
    <div class="modal fade" id="addBookModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data"
                class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Buku</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Kode Buku</label>
                        <input type="text" name="book_code" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Judul</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Penulis</label>
                        <input type="text" name="author" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Tahun</label>
                        <input type="number" name="year" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select id="addCategories" class="form-select" name="categories[]" multiple="multiple">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Deskripsi</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Link Gambar</label>
                        <input type="text" name="image" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Detail -->
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
                                <img src="{{ $book->image }}" class="cover-img">
                            @else
                                <div class="text-muted">Tidak ada gambar</div>
                            @endif
                        </div>
                        <div class="col-md-7">
                            <p><strong>Code:</strong> {{ $book->book_code }}</p>
                            <p><strong>Title:</strong> {{ $book->title }}</p>
                            <p><strong>Author:</strong> {{ $book->author }}</p>
                            <p><strong>Year:</strong> {{ $book->year }}</p>
                            <p><strong>Kategori:</strong>
                                @foreach ($book->categories as $cat)
                                    <span class="badge bg-primary">{{ $cat->name }}</span>
                                @endforeach
                            </p>
                            <p><strong>Description:</strong><br>{{ $book->description }}</p>
                            <p><strong>Status:</strong> {{ ucfirst($book->status) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit -->
        <div class="modal fade" id="editModal{{ $book->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data"
                    class="modal-content">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Buku</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Kode Buku</label>
                            <input type="text" name="book_code" class="form-control"
                                value="{{ $book->book_code }}" required>
                        </div>
                        <div class="mb-3">
                            <label>Judul</label>
                            <input type="text" name="title" class="form-control" value="{{ $book->title }}"
                                required>
                        </div>
                        <div class="mb-3">
                            <label>Penulis</label>
                            <input type="text" name="author" class="form-control" value="{{ $book->author }}">
                        </div>
                        <div class="mb-3">
                            <label>Tahun</label>
                            <input type="number" name="year" class="form-control" value="{{ $book->year }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kategori</label>
                            <select id="editCategories{{ $book->id }}" class="form-select" name="categories[]"
                                multiple="multiple">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $book->categories->contains($category->id) ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Deskripsi</label>
                            <textarea name="description" class="form-control">{{ $book->description }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label>Link Gambar</label>
                            <input type="text" name="image" class="form-control" value="{{ $book->image }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $('#addBookModal').on('shown.bs.modal', function() {
            $('#addCategories').select2({
                dropdownParent: $('#addBookModal'),
                width: '100%',
                placeholder: "Pilih kategori",
                allowClear: true
            });
        });

        @foreach ($books as $book)
            $('#editModal{{ $book->id }}').on('shown.bs.modal', function() {
                $('#editCategories{{ $book->id }}').select2({
                    dropdownParent: $('#editModal{{ $book->id }}'),
                    width: '100%',
                    placeholder: "Pilih kategori",
                    allowClear: true
                });
            });
        @endforeach
    </script>


</body>

</html>
