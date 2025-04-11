<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>e-rentBook | Book Rent</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        .navbar-brand {
            font-weight: 600;
        }

        .form-box {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .select2-container .select2-selection--single {
            height: 38px;
            padding: 4px 12px;
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
                    <li class="nav-item"><a class="nav-link active" href="book-rent">Book Rent</a></li>
                    <li class="nav-item"><a class="nav-link" href="rent-logs">Rent Logs</a></li>
                    <li class="nav-item"><a class="nav-link text-danger" href="logout">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Book Rent Form -->
    <div class="container my-5">
        <h2 class="mb-4 text-center">Form Peminjaman Buku</h2>
        <div class="form-box">

            @if (session('message'))
                <div class="alert {{ session('alert-class') }}">
                    {{ session('message') }}</div>
            @endif

            <form action="" method="POST">
                @csrf

                <!-- Mode Peminjaman atau Pengembalian -->
                <div class="mb-3">
                    <label for="action" class="form-label">Pilih Aksi</label>
                    <select name="action" id="action" class="form-select" required>
                        <option value="">-- Pilih Aksi --</option>
                        <option value="rent">Peminjaman</option>
                        <option value="return">Pengembalian</option>
                    </select>
                </div>


                <div class="mb-3">
                    <label for="user_id" class="form-label">Pilih Pengguna</label>
                    <select name="user_id" id="user_id" class="form-select select2" required>
                        <option value="">-- Pilih User --</option>
                        @foreach ($users as $item)
                            <option value="{{ $item->id }}">{{ $item->username }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="book_id" class="form-label">Pilih Buku</label>
                    <select name="book_id" id="book_id" class="form-select select2" required>
                        <option value="">-- Pilih Buku --</option>
                        @foreach ($books as $item)
                            <option value="{{ $item->id }}">{{ $item->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-success">Proses</button>
                </div>
            </form>

        </div>
    </div>

    <!-- JS Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#mode').on('change', function() {
                const isReturn = $(this).val() === 'return';
                const submitText = isReturn ? 'Proses Pengembalian' : 'Submit Peminjaman';
                $('.btn-success').text(submitText);
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Silakan pilih",
                allowClear: true,
                width: '100%'
            });
        });
    </script>
</body>

</html>
