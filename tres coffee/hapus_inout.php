<?php
include("koneksi.php");

if (isset($_GET['id'])) {
    $id_inout = $_GET['id'];

    // Ambil data transaksi yang akan dihapus
    $sql = "SELECT * FROM inout_bean WHERE id_inout = '$id_inout'";
    $result = mysqli_query($db, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $id_barang = $row['id_barang'];
        $jenis_transaksi = $row['jenis_transaksi'];
        $jumlah = $row['jumlah'];

        // Ambil stok barang saat ini
        $stok_sql = "SELECT jumlah_bean FROM beans WHERE id = '$id_barang'";
        $stok_result = mysqli_query($db, $stok_sql);
        $stok_row = mysqli_fetch_assoc($stok_result);
        $stok_sekarang = $stok_row['jumlah_bean'];

        // Sesuaikan stok berdasarkan jenis transaksi
        if ($jenis_transaksi == ) {
            $stok_baru = $stok_sekarang - $jumlah; // Kurangi stok jika transaksi masuk
        } else {
            $stok_baru = $stok_sekarang + $jumlah; // Tambah stok jika transaksi keluar
        }

        // Update stok di database
        $update_sql = "UPDATE beans SET jumlah_bean = '$stok_baru' WHERE id = '$id_barang'";

        // Hapus data transaksi
        $delete_sql = "DELETE FROM inout_bean WHERE id_inout = '$id_inout'";

        if (mysqli_query($db, $update_sql) && mysqli_query($db, $delete_sql)) {
            echo "<script>alert('Data berhasil dihapus!'); window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('Gagal menghapus data!');</script>";
        }
    } else {
        echo "<script>alert('Data tidak ditemukan!');</script>";
    }
} else {
    echo "<script>alert('ID tidak valid!');</script>";
}
?>
