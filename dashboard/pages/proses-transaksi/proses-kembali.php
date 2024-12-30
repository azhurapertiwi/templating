<?php
session_start();
include('../../components/koneksi.php');

if (!isset($_POST['btn-submit'])) {
    header('location: ../../index.php');
    exit();
}

$nik_anggota = $_POST['nik_anggota'];
$tanggal_kembali = $_POST['tanggal_kembali'];

// validasi jika anggota tidak ada
$sql = "SELECT * FROM anggota WHERE nik='$nik_anggota'";
$query = mysqli_query($koneksi, $sql);
$data = mysqli_num_rows($query);

if ($nik_anggota == '') {
    $_SESSION['msg']['nik_anggota'] = "Tidak ada NIK yang dicari!";
} else if ($data == 0) {
    $_SESSION['msg']['nik_anggota'] = '';
}

if ($tanggal_kembali == '') {
    $_SESSION['msg']['tanggal_kembali'] = "Isi tanggal pengembalian!";
}
if (isset($_SESSION['msg'])) {
    header('location: ../../?page=transaksi-pinjam');
    exit();
}

// Mulai transaksi
mysqli_autocommit($koneksi, false); // Mulai transaksi untuk konsistensi data

try {
    // 1. Update tanggal_kembali di tabel transaksi
    $sqlUpdateTransaksi = "UPDATE transaksi SET tanggal_kembali='$tanggal_kembali' WHERE nik_anggota='$nik_anggota'";
    $queryUpdateTransaksi = mysqli_query($koneksi, $sqlUpdateTransaksi);
    if (!$queryUpdateTransaksi) {
        throw new Exception("Gagal mengupdate tanggal_kembali: " . mysqli_error($koneksi));
    }

    // 2. Ambil id_transaksi berdasarkan nik_anggota
    $sqlGetTransaksi = "SELECT id FROM transaksi WHERE nik_anggota='$nik_anggota' AND tanggal_kembali='$tanggal_kembali'";
    $resultTransaksi = mysqli_query($koneksi, $sqlGetTransaksi);
    if (!$resultTransaksi) {
        throw new Exception("Gagal mendapatkan id_transaksi: " . mysqli_error($koneksi));
    }
    $dataTransaksi = mysqli_fetch_array($resultTransaksi);
    $id_transaksi = $dataTransaksi['id'];

    // 3. Hapus semua detail_transaksi terkait id_transaksi
    // $sqlDeleteDetail = "DELETE FROM detail_transaksi WHERE id_transaksi='$id_transaksi'";
    // $queryDeleteDetail = mysqli_query($koneksi, $sqlDeleteDetail);
    // if (!$queryDeleteDetail) {
    //    throw new Exception("Gagal menghapus data dari detail_transaksi: " . mysqli_error($koneksi));
    // }

    // Commit transaksi
    mysqli_commit($koneksi);

    // Set pesan sukses
    $_SESSION['msg']['sukses'] = "Buku peminjaman <b>" . $nik_anggota . "</b> berhasil dikembalikan!";
    unset($_SESSION['value']);
    header('location: ../../?page=transaksi-data');
    exit();
} catch (Exception $e) {
    // Rollback jika terjadi error
    mysqli_rollback($koneksi);
    $_SESSION['msg']['failed'] = "Terjadi kesalahan saat memproses data: " . $e->getMessage();
    header('location: ../../?page=transaksi-pinjam');
    exit();
}
