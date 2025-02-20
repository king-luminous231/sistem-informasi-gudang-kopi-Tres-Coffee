<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Tres Coffee</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="barang.php">Daftar Barang</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Container -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0 text-center">Tambah Barang</h3>
                    </div>
                    <div class="card-body">
                        <form action="simpan_barang.php" method="POST">
                            
                            <!-- ID Barang -->
                            <div class="mb-3">
                                <label for="xid" class="form-label">ID Barang</label>
                                <input type="text" id="xid" name="xid" class="form-control" required>
                            </div>

                            <!-- Nama Barang -->
                            <div class="mb-3">
                                <label for="xnama" class="form-label">Nama Barang</label>
                                <select id="xnama" name="xnama" class="form-select" required>
                                    <option value="">-- Pilih Barang --</option>
                                    <option value="Kopi Arabika">Kopi Arabika</option>
                                    <option value="Kopi Robusta">Kopi Robusta</option>
                                    <option value="Kopi Liberika">Kopi Liberika</option>
                                    <option value="Kopi Excelsa">Kopi Excelsa</option>
                                </select>
                            </div>

                            <!-- Jumlah Barang -->
                            <div class="mb-3">
                                <label for="xjumlah" class="form-label">Jumlah Barang (gram)</label>
                                <input type="number" id="xjumlah" name="xjumlah" class="form-control" required placeholder="Masukkan jumlah dalam gram">
                            </div>

                            <!-- Tombol Simpan -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success">Simpan Data</button>
                                <a href="barang.php" class="btn btn-secondary mt-2">Kembali</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
