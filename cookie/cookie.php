<?php
// Mulai session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola State dengan Cookie</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Gaya CSS */
        body {
            background: linear-gradient(120deg, #f5f7fa, #c3cfe2);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            max-width: 600px;
            width: 100%;
        }
        h1 {
            font-weight: bold;
            color: #333;
        }
        .btn {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .card {
            border: none;
        }
        .card-title {
            font-weight: bold;
            color: #495057;
        }
        .list-group-item {
            background-color: #f8f9fa;
            border: none;
        }
        .list-group-item strong {
            color: #495057;
        }
        .list-group-item span {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Cookie & Browser Storage</h1>

        <!-- Back Button -->
        <div class="mb-4 text-start">
            <button type="button" class="btn btn-secondary" onclick="history.back()">&laquo; Kembali</button>
    </div>

            <!-- Form untuk menetapkan nilai -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="card-title">Kelola Cookie</h5>
            <form id="stateForm">
            <div class="mb-3">
                <label for="cookieNameInput" class="form-label">Nama Cookie:</label>
                <input type="text" id="cookieNameInput" class="form-control" placeholder="Masukkan nama cookie..." required>
            </div>

                <div class="mb-3">
                    <label for="stateInput" class="form-label">Masukkan Nilai Cookie:</label>
                    <input type="text" id="stateInput" class="form-control" placeholder="Ketik sesuatu..." required>
                </div>
                <div class="d-flex gap-2 justify-content-center">
                    <button type="button" id="setCookieBtn" class="btn btn-primary">Set Cookie</button>
                    <button type="button" id="setLocalStorageBtn" class="btn btn-success">Set LocalStorage</button>
                    <button type="button" id="setSessionStorageBtn" class="btn btn-warning">Set SessionStorage</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Form untuk mendapatkan nilai cookie -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="card-title">Ambil Cookie</h5>
            <form id="getCookieForm">
                <div class="mb-3">
                    <label for="getCookieInput" class="form-label">Masukkan Nama Cookie:</label>
                    <input type="text" id="getCookieInput" class="form-control" placeholder="Nama cookie..." required>
                </div>
                <div class="d-flex gap-2 justify-content-center">
                    <button type="button" id="getCookieBtn" class="btn btn-info">Get Cookie</button>
                </div>
            </form>
            <div id="cookieResult" class="mt-3 text-center text-muted">Hasil cookie akan tampil di sini.</div>
        </div>
    </div>

        <!-- Tampilan nilai yang tersimpan -->
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Nilai yang Tersimpan</h5>
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <strong>Nilai Cookie:</strong>
                        <span id="cookieDisplay" class="text-muted">Belum ada nilai</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <strong>Nilai LocalStorage:</strong>
                        <span id="localStorageDisplay" class="text-muted">Belum ada nilai</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <strong>Nilai SessionStorage:</strong>
                        <span id="sessionStorageDisplay" class="text-muted">Belum ada nilai</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- JavaScript untuk Cookie dan Storage -->
    <script src="cookie.js"></script>
</body>
</html>