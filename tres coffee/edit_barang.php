<?php
include("koneksi.php"); // Pastikan file koneksi ada

// Pastikan ID barang tersedia
if (!isset($_GET['id'])) {
    echo "<script>alert('ID barang tidak ditemukan!'); window.location.href='barang.php';</script>";
    exit;
}

$id_barang = $_GET['id'];

// Ambil data barang berdasarkan ID
$sql = "SELECT * FROM beans WHERE id = '$id_barang'";
$result = mysqli_query($db, $sql);

if (mysqli_num_rows($result) == 0) {
    echo "<script>alert('Data tidak ditemukan!'); window.location.href='barang.php';</script>";
    exit;
}

$row = mysqli_fetch_assoc($result);

// Jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_barang = $_POST['xnama'];
    $jumlah_barang = $_POST['xjumlah'];

    // Update data ke database
    $updatesql = "UPDATE beans SET nama_bean = '$nama_barang', jumlah_bean = '$jumlah_barang' WHERE id = '$id_barang'";

    if (mysqli_query($db, $update_sql)) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location.href='barang.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang</title>
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
                    <div class="card-header bg-warning text-white">
                        <h3 class="mb-0 text-center">Edit Barang</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="">
                            
                            <!-- ID Barang (Hidden) -->
                            <input type="hidden" name="xid" value="<?php echo $row['id']; ?>">

                            <!-- Nama Barang -->
                            <div class="mb-3">
                                <label for="xnama" class="form-label">Nama Barang</label>
                                <select id="xnama" name="xnama" class="form-select" required>
                                    <option value="Kopi Arabika" <?php echo ($row['nama_bean'] == 'Kopi Arabika') ? "selected" : ""; ?>>Kopi Arabika</option>
                                    <option value="Kopi Robusta" <?php echo ($row['nama_bean'] == 'Kopi Robusta') ? "selected" : ""; ?>>Kopi Robusta</option>
                                    <option value="Kopi Liberika" <?php echo ($row['nama_bean'] == 'Kopi Liberika') ? "selected" : ""; ?>>Kopi Liberika</option>
                                    <option value="Kopi Excelsa" <?php echo ($row['nama_bean'] == 'Kopi Excelsa') ? "selected" : ""; ?>>Kopi Excelsa</option>
                                </select>
                            </div>

                            <!-- Jumlah Barang -->
                            <div class="mb-3">
                                <label for="xjumlah" class="form-label">Jumlah Barang (gram)</label>
                                <input type="number" id="xjumlah" name="xjumlah" class="form-control" value="<?php echo $row['jumlah_bean']; ?>" required>
                            </div>

                            <!-- Tombol Update -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Update Data</button>
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
