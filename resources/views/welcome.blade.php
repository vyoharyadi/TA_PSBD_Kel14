<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>e-rentBook | Selamat Datang</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: url('https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?auto=format&fit=crop&w=1470&q=80') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
        }

        .overlay {
            background-color: rgba(0, 0, 0, 0.6);
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            pointer-events: none;
        }

        .main {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            position: relative;
            z-index: 1;
            color: #fff;
            padding: 60px 20px;
            flex-direction: column;
        }

        .main h1 {
            font-size: 3rem;
            font-weight: 700;
        }

        .main p {
            font-size: 1.2rem;
            margin-bottom: 30px;
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }

        .btn-custom {
            padding: 10px 30px;
            border-radius: 50px;
            font-weight: 500;
            margin: 5px;
        }
    </style>
</head>

<body>

    <!-- Overlay -->
    <div class="overlay"></div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
        <div class="container">
            <a class="navbar-brand" href="#">📚 e-rentBook</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <!-- Main Welcome Section -->
    <div class="container main">
        <h1>Selamat Datang di <br><strong>e-rentBook</strong> 👋</h1>
        <p>Platform digital untuk meminjam buku secara praktis dan cepat dari perpustakaan kesayangan kita.</p>
        <div>
            <a href="login" class="btn btn-primary btn-custom">Login</a>
            <a href="register" class="btn btn-outline-light btn-custom">Sign Up</a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tYb0+1bafzH6Uu0dIGr6kS3x+QkPvj+hcY6FwnzFlvN2PRJr59b6EGGo" crossorigin="anonymous">
    </script>

</body>

</html>
