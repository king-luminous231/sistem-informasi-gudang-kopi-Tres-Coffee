<?php
include("koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_barang = $_POST['id_barang'];
    $jumlah_masuk = $_POST['jumlah_masuk'];
    $tanggal = date('Y-m-d');

    // Ambil data barang berdasarkan ID
    $sql = "SELECT jumlah_bean FROM beans WHERE id = '$id_barang'";
    $result = mysqli_query($db, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $jumlah_sekarang = $row['jumlah_bean'];
        $jumlah_baru = $jumlah_sekarang + $jumlah_masuk;

        // Update jumlah barang dan catat transaksi masuk
        $update_sql = "UPDATE beans SET jumlah_bean = '$jumlah_baru' WHERE id = '$id_barang'";
        $insert_sql = "INSERT INTO inout_bean (id_barang, jenis_transaksi, jumlah, tanggal_transaksi) VALUES ('$id_barang', 'IN', '$jumlah_masuk', '$tanggal')";

        if (mysqli_query($db, $update_sql) && mysqli_query($db, $insert_sql)) {
            echo "<script>alert('Barang masuk berhasil ditambahkan!'); window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('Gagal menambahkan barang masuk!');</script>";
        }
    } else {
        echo "<script>alert('Barang tidak ditemukan!');</script>";
    }
}

// Ambil daftar barang untuk dropdown
$barang_sql = "SELECT * FROM beans ORDER BY nama_bean";
$barang_result = mysqli_query($db, $barang_sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang Masuk</title>
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
                    <li class="nav-item"><a class="nav-link active" href="in.php">Barang Masuk</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Container -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg">
                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0 text-center">Tambah Barang Masuk</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="">
                            
                            <!-- Pilih Barang -->
                            <div class="mb-3">
                                <label for="id_barang" class="form-label">Pilih Barang</label>
                                <select name="id_barang" class="form-select" required>
                                    <option value="">-- Pilih Barang --</option>
                                    <?php while ($barang = mysqli_fetch_assoc($barang_result)) { ?>
                                        <option value="<?php echo $barang['id']; ?>">
                                            <?php echo $barang['nama_bean']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <!-- Jumlah Barang Masuk -->
                            <div class="mb-3">
                                <label for="jumlah_masuk" class="form-label">Jumlah Masuk (gram)</label>
                                <input type="number" name="jumlah_masuk" class="form-control" required placeholder="Masukkan jumlah dalam gram">
                            </div>

                            <!-- Tombol Simpan -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success">Simpan Data</button>
                                <a href="index.php" class="btn btn-secondary mt-2">Kembali</a>
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
