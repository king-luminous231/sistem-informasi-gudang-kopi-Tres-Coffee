<?php
include("koneksi.php");

if (!isset($_GET['id'])) {
    echo "<script>alert('ID tidak ditemukan!'); window.location.href='index.php';</script>";
    exit;
}

$id_inout = mysqlireal_escape_string($db, $_GET['id']);

// Ambil data transaksi berdasarkan ID
$sql = "SELECT * FROM inout_bean WHERE id_inout = '$id_inout'";
$result = mysqli_query($db, $sql);

if (mysqli_num_rows($result) == 0) {
    echo "<script>alert('Data tidak ditemukan!'); window.location.href='index.php';</script>";
    exit;
}

$row = mysqli_fetch_assoc($result);
$id_barang = $row['id_barang'];
$jenis_transaksi = $row['jenis_transaksi'];
$jumlah = $row['jumlah'];
$tanggal = $row['tanggal_transaksi'];

// Ambil daftar barang untuk dropdown
$barang_sql = "SELECT * FROM beans ORDER BY nama_bean";
$barang_result = mysqli_query($db, $barang_sql);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_barang_baru = $_POST['id_barang'];
    $jumlah_baru = $_POST['jumlah'];
    $tanggal_baru = $_POST['tanggal_transaksi'];

    // Ambil jumlah stok barang sebelum update
    $sql_bean_lama = "SELECT jumlah_bean FROM beans WHERE id = '$id_barang'";
    $result_bean_lama = mysqli_query($db, $sql_bean_lama);
    $row_bean_lama = mysqli_fetch_assoc($result_bean_lama);
    $jumlah_stok_lama = $row_bean_lama['jumlah_bean'];

    $sql_bean_baru = "SELECT jumlah_bean FROM beans WHERE id = '$id_barang_baru'";
    $result_bean_baru = mysqli_query($db, $sql_bean_baru);
    $row_bean_baru = mysqli_fetch_assoc($result_bean_baru);
    $jumlah_stok_baru = $row_bean_baru['jumlah_bean'];

    // Perbaikan logika pengurangan & penambahan stok
    if ($jenis_transaksi == 'IN') {
        // Kembalikan stok lama sebelum update
        $jumlah_stok_lama -= $jumlah;

        // Tambahkan stok baru
        $jumlah_stok_baru += $jumlah_baru;
    } else { // Jika barang keluar
        // Kembalikan stok lama sebelum update
        $jumlah_stok_lama += $jumlah;

        // Cek apakah stok cukup untuk update baru
        if ($jumlah_baru > $jumlah_stok_baru) {
            echo "<script>alert('Jumlah barang tidak mencukupi!');</script>";
            exit;
        }

        // Kurangi stok baru
        $jumlah_stok_baru -= $jumlah_baru;
    }

    // Update data transaksi
    $update_sql = "UPDATE inout_bean 
                   SET id_barang = '$id_barang_baru', jumlah = '$jumlah_baru', tanggal_transaksi = '$tanggal_baru' 
                   WHERE id_inout = '$id_inout'";
    
    // Update stok barang lama dan baru
    $update_stok_lama_sql = "UPDATE beans SET jumlah_bean = '$jumlah_stok_lama' WHERE id = '$id_barang'";
    $update_stok_baru_sql = "UPDATE beans SET jumlah_bean = '$jumlah_stok_baru' WHERE id = '$id_barang_baru'";

    if (mysqli_query($db, $update_sql) && mysqli_query($db, $update_stok_lama_sql) && mysqli_query($db, $update_stok_baru_sql)) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location.href='index.php';</script>";
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
    <title>Edit Data Barang</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Kongkow Coffee</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="barang.php">Daftar Barang</a></li>
                    <li class="nav-item"><a class="nav-link active" href="edit_inout.php?id=<?php echo $id_inout; ?>">Edit Barang</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Form Edit Barang -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0 text-center">Edit Barang <?php echo ($jenis_transaksi == 'IN') ? "Masuk" : "Keluar"; ?></h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="">
                            
                            <!-- Pilih Barang -->
                            <div class="mb-3">
                                <label for="id_barang" class="form-label">Pilih Barang</label>
                                <select name="id_barang" class="form-select" required>
                                    <?php while ($barang = mysqli_fetch_assoc($barang_result)) { ?>
                                        <option value="<?php echo $barang['id']; ?>" <?php echo ($barang['id'] == $id_barang) ? "selected" : ""; ?>>
                                            <?php echo $barang['nama_bean']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <!-- Jumlah -->
                            <div class="mb-3">
                                <label for="jumlah" class="form-label">Jumlah</label>
                                <input type="number" name="jumlah" class="form-control" value="<?php echo $jumlah; ?>" required>
                            </div>

                            <!-- Tanggal -->
                            <div class="mb-3">
                                <label for="tanggal_transaksi" class="form-label">Tanggal</label>
                                <input type="date" name="tanggal_transaksi" class="form-control" value="<?php echo $tanggal; ?>" required>
                            </div>

                            <!-- Tombol Simpan -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="index.php" class="btn btn-secondary mt-2">Kembali</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
