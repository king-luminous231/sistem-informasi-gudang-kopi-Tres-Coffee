<?php   
include("koneksi.php");

$sql = "SELECT a.*, b.nama_bean FROM inout_bean a 
        JOIN beans b ON a.id_barang = b.id 
        ORDER BY a.id_inout DESC"; // Ubah urutan menjadi DESC agar data terbaru muncul di atas

$result = mysqli_query($db, $sql);

$i = 1;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang Masuk/Keluar</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        /* Efek hover pada tabel */
        tbody tr:hover {
            background-color: #f8f9fa;
            transition: 0.3s;
        }
    </style>
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
                    <li class="nav-item"><a class="nav-link" href="in.php">Barang Masuk</a></li>
                    <li class="nav-item"><a class="nav-link" href="out.php">Barang Keluar</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Container -->
    <div class="container mt-5">
        <h3 class="text-center mb-4">📊 Data Barang Masuk/Keluar</h3>

        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>IN/OUT</th>
                        <th>Nama Bean</th>
                        <th>Jumlah Bean</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php   
                    while ($row = mysqli_fetch_array($result)) {                                            
                    ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td>
                                <span class="badge bg-<?php echo ($row['jenis_transaksi'] == 'IN') ? 'success' : 'danger'; ?>">
                                    <?php echo $row['jenis_transaksi']; ?>
                                </span>
                            </td>                                                             
                            <td><?php echo $row['nama_bean']; ?></td>                                                             
                            <td><?php echo $row['jumlah']; ?> gram</td>                                                             
                            <td><?php echo date('d-m-Y', strtotime($row['tanggal_transaksi'])); ?></td>                        
                            <td>
                                <a href="edit_inout.php?id=<?php echo $row['id_inout']; ?>" class="btn btn-warning btn-sm">✏️ Edit</a>
                                <a href="hapus_inout.php?id=<?php echo $row['id_inout']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">🗑️ Hapus</a>                     
                            </td>        
                        </tr>
                    <?php
                        $i++;
                    }                   
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
