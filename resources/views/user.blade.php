<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>e-rentBook | Users</title>

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
                    <li class="nav-item"><a class="nav-link active" href="users">Users</a></li>
                    <li class="nav-item"><a class="nav-link" href="book-rent">Book Rent</a></li>
                    <li class="nav-item"><a class="nav-link" href="rent-logs">Rent Logs</a></li>
                    <li class="nav-item"><a class="nav-link text-danger" href="logout">Logout</a></li>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <h2 class="mb-4">Manajemen User</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Tombol Filter -->
        <div class="mb-3">
            <a href="{{ route('users.index') }}" class="btn btn-primary me-2">Active User</a>
            <a href="{{ route('users.inactive') }}" class="btn btn-secondary me-2">Inactive User</a>
            <a href="{{ route('users.banned') }}" class="btn btn-danger">Banned User</a>
        </div>

        <!-- Tabel User Aktif -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover bg-white">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Status</th>
                        <th style="width: 220px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $index => $user)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ ucfirst($user->status) }}</td>
                            <td>
                                <!-- Detail -->
                                <button class="btn btn-info btn-sm me-1" data-bs-toggle="modal"
                                    data-bs-target="#detailModal{{ $user->id }}">
                                    Detail
                                </button>
                                <!-- Edit -->
                                <button class="btn btn-warning btn-sm me-1" data-bs-toggle="modal"
                                    data-bs-target="#editModal{{ $user->id }}">
                                    Edit
                                </button>
                                <!-- Ban/Activate/Unban -->
                                @php
                                    $actionLabel = '';
                                    $actionRoute = '';
                                    $confirmMessage = '';

                                    switch ($statusView) {
                                        case 'active':
                                            $actionLabel = 'Ban';
                                            $actionRoute = route('users.ban', $user->id);
                                            $confirmMessage = 'Yakin ingin ban user ini?';
                                            $buttonClass = 'btn btn-danger btn sm';
                                            break;
                                        case 'inactive':
                                            $actionLabel = 'Activate';
                                            $actionRoute = route('users.activate', $user->id);
                                            $confirmMessage = 'Yakin ingin mengaktifkan user ini?';
                                            $buttonClass = 'btn btn-primary btn-sm';
                                            break;
                                        case 'banned':
                                            $actionLabel = 'Unban';
                                            $actionRoute = route('users.unban', $user->id);
                                            $confirmMessage = 'Yakin ingin unban user ini?';
                                            $buttonClass = 'btn btn-success btn-sm';
                                            break;
                                    }
                                @endphp

                                <form action="{{ $actionRoute }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('{{ $confirmMessage }}')">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                        class="btn btn-sm {{ $buttonClass }}">{{ $actionLabel }}</button>
                                </form>

                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada user.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Detail -->
    @foreach ($users as $user)
        <div class="modal fade" id="detailModal{{ $user->id }}" tabindex="-1"
            aria-labelledby="detailModalLabel{{ $user->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detail User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Username:</strong> {{ $user->username }}</p>
                        <p><strong>Email:</strong> {{ $user->email }}</p>
                        <p><strong>Phone:</strong> {{ $user->phone }}</p>
                        <p><strong>Address:</strong> {{ $user->address }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>

                        <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus user ini? Semua data terkait akan hilang!')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit -->
        <div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1"
            aria-labelledby="editModalLabel{{ $user->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('users.update', $user->id) }}" method="POST" class="modal-content">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Edit User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control"
                                value="{{ $user->username }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ $user->email }}"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" name="phone" class="form-control" value="{{ $user->phone }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <textarea name="address" class="form-control">{{ $user->address }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
