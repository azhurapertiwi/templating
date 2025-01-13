<?php
session_start();
include('../../components/koneksi.php');

if (!isset($_POST['btn-submit'])) {
    header('location: ../../?page=dashboard');
    exit();
}

$nik_anggota = $_POST['nik_anggota'];
$nama_anggota = $_POST['nama_anggota'];
$tgl_pinjam = $_POST['tgl_pinjam'];

$buku = [];
for ($i = 1; $i <= 5; $i++) {
    $kode_buku = isset($_POST["buku$i"]) ? $_POST["buku$i"] : null;
    if (!empty($kode_buku)) {
        $buku[] = ['kode_buku' => $kode_buku];
    }
}

if ($nik_anggota == '') {
    $_SESSION['msg']['err-nik'] = 'NIK tidak boleh kosong';
}
if (mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM transaksi WHERE nik_anggota='$nik_anggota' AND tgl_kembali IS NULL")) != 0) {
    $_SESSION['msg']['failed'] = 'Anggota belum mengembalikan buku';
}
if ($tgl_pinjam == '') {
    $_SESSION['msg']['err-tgl'] = 'Tentukan tanggal peminjaman';
}
if (empty($buku)) {
    $_SESSION['msg']['err-buku'] = 'Pilih buku yang ingin dipinjam';
} else {
    $kode = []; // Array untuk menyimpan kode buku yang diinput
    foreach ($buku as $buk) {
        // Validasi apakah buku dengan kode yang sama sudah ada di input
        if (in_array($buk['kode_buku'], $kode)) {
            $_SESSION['msg']['err-buku'] = "Tidak bisa meminjam buku dengan kode yang sama!";
            break;
        }
        $kode[] = $buk['kode_buku']; // Tambahkan kode ke array jika belum ada

        // Validasi apakah buku ada di database
        $sql = "SELECT * FROM buku WHERE kode='{$buk['kode_buku']}'";
        $query = mysqli_query($koneksi, $sql);
        if (mysqli_num_rows($query) == 0) {
            $_SESSION['msg']['buk'] = "Buku dengan kode '{$buk['kode_buku']}' tidak ditemukan!";
            break;
        }
    }
}

if (isset($_SESSION['msg'])) {
    header('location: ../../?page=transaksi-pinjam');
    exit();
}


// mulai transaksi
mysqli_autocommit($koneksi, false);

$queryTransaksi = "INSERT INTO transaksi (id, nik_anggota, tgl_pinjam, tgl_kembali) VALUES (NULL, '$nik_anggota', '$tgl_pinjam', NULL)";

mysqli_query($koneksi, $queryTransaksi);

$id_transaksi = mysqli_insert_id($koneksi);

foreach($buku as $buk) {
    $buk = $buk['kode_buku'];
    $queryDetail = "INSERT INTO detail_transaksi (id, id_transaksi, nik_anggota, kode_buku) VALUES (NULL, '$id_transaksi', '$nik_anggota', '$buk')";
    mysqli_query($koneksi, $queryDetail);
}

mysqli_commit($koneksi);
$_SESSION['msg']['sukses'] = "Transaksi peminjaman buku berhasil!";
header('location: ../../?page=transaksi-pinjam');
exit();

mysqli_rollback($koneksi);
$_SESSION['msg']['failed'] = "Terjadi kesalahan: " . $e->getMessage();
header('location: ../../?page=transaksi-pinjam');
exit();