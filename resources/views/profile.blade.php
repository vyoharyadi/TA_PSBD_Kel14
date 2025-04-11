<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>e-rentBook | Profil Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f2f2f2;
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }

        .profile-container {
            background-color: white;
            padding: 40px;
            margin: 50px auto;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            max-width: 700px;
        }

        .profile-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .profile-header h2 {
            font-weight: 600;
        }

        .profile-row {
            display: grid;
            grid-template-columns: 40px auto;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }

        .profile-row:last-child {
            border-bottom: none;
        }

        .profile-icon {
            font-size: 1.2rem;
            color: #555;
            text-align: center;
        }

        .profile-label {
            font-weight: 500;
            color: #444;
        }

        .status-badge {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.9rem;
        }

        .status-active {
            background-color: #198754;
            color: white;
        }

        .status-banned {
            background-color: #dc3545;
            color: white;
        }

        .status-inactive {
            background-color: #6c757d;
            color: white;
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
                        <a class="nav-link active" href="{{ route('profile') }}">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('booklist') }}">Daftar Buku</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn-danger" href="{{ url('logout') }}">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Profile Section -->
    <div class="container">
        <div class="profile-container">
            <div class="profile-header">
                <h2>👤 Profil Pengguna</h2>
                <span
                    class="status-badge
                    {{ $user->status === 'active' ? 'status-active' : ($user->status === 'banned' ? 'status-banned' : 'status-inactive') }}">
                    {{ ucfirst($user->status) }}
                </span>
            </div>

            <div class="profile-row">
                <div class="profile-icon"><i class="bi bi-person"></i></div>
                <div><span class="profile-label">Username:</span> {{ $user->username }}</div>
            </div>
            <div class="profile-row">
                <div class="profile-icon"><i class="bi bi-envelope"></i></div>
                <div><span class="profile-label">Email:</span> {{ $user->email }}</div>
            </div>
            <div class="profile-row">
                <div class="profile-icon"><i class="bi bi-telephone"></i></div>
                <div><span class="profile-label">Telepon:</span> {{ $user->phone ?? '-' }}</div>
            </div>
            <div class="profile-row">
                <div class="profile-icon"><i class="bi bi-geo-alt"></i></div>
                <div><span class="profile-label">Alamat:</span> {{ $user->address ?? '-' }}</div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
