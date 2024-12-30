<?php
session_start();
include('../../components/koneksi.php');

if (!isset($_POST['btn-submit'])) {
   header('location: ../../index.php');
   exit();
}

$nik_anggota = $_POST['nik_anggota'];
$nama_anggota = $_POST['nama_anggota'];
$tanggal_pinjam = $_POST['tanggal_pinjam'];
$books = array_filter([
   ($_POST['buku1']) ? $_POST['buku1'] : '', // $_POST['buku1'] ?? ''
   ($_POST['buku2']) ? $_POST['buku2'] : '',
   ($_POST['buku3']) ? $_POST['buku3'] : '',
   ($_POST['buku4']) ? $_POST['buku4'] : '',
   ($_POST['buku5']) ? $_POST['buku5'] : '',
]);

// validasi jika anggota tidak ada
$sql = "SELECT * FROM anggota WHERE nik='$nik_anggota'";
$query = mysqli_query($koneksi, $sql);
$data = mysqli_num_rows($query);

if ($nik_anggota == '') {
   $_SESSION['msg']['nik_anggota'] = "Tidak ada NIK yang dicari!";
} else if ($data == 0) {
   $_SESSION['msg']['nik_anggota'] = '';
}
if ($tanggal_pinjam == '') {
   $_SESSION['msg']['tanggal_pinjam'] = "Isi tanggal peminjaman!";
}

// validasi jika buku tidak ada
$sql2 = "SELECT * FROM buku WHERE kode='$books'";
$query2 = mysqli_query($koneksi, $sql2);
$data2 = mysqli_num_rows($query2);

if (empty($books)) {
   $_SESSION['msg']['buku'] = "Pilih buku yang ingin dipinjam!";
} else if ('what?') {
   // how to validate?;
}

if (isset($_SESSION['msg'])) {
   header('location: ../../?page=transaksi-pinjam');
   exit();
}

// Mulai transaksi database
mysqli_autocommit($koneksi, false); // Mulai transaksi

try {
   // 1. Masukkan data ke tabel transaksi
   $queryTransaksi = "INSERT INTO transaksi (id, nik_anggota, tanggal_pinjam, tanggal_kembali) VALUES (NULL,'$nik_anggota', '$tanggal_pinjam', NULL)";
   $resultTransaksi = mysqli_query($koneksi, $queryTransaksi);
   if (!$resultTransaksi) {
      throw new Exception("Gagal memasukkan data ke tabel transaksi: " . mysqli_error($koneksi));
   }

   // Ambil id transaksi yang baru saja dimasukkan
   $idTransaksi = mysqli_insert_id($koneksi);

   // 2. Masukkan data ke tabel detail_transaksi untuk setiap buku
   foreach ($books as $buku) {
      $queryDetail = "INSERT INTO detail_transaksi (id, id_transaksi, nik_anggota, kode_buku) VALUES (NULL, '$idTransaksi', '$nik_anggota', '$buku')";
      $resultDetail = mysqli_query($koneksi, $queryDetail);
      if (!$resultDetail) {
         throw new Exception("Gagal memasukkan data ke tabel detail_transaksi: " . mysqli_error($koneksi));
      }
   }

   // Commit transaksi
   mysqli_commit($koneksi);

   // Redirect ke halaman sukses atau reset form
   $_SESSION['msg']['sukses'] = "TRANSAKSI PEMINJAMAN BUKU BERHASIL!";
   unset($_SESSION['value']);
   header('location: ../../?page=transaksi-pinjam');
   exit();
} catch (Exception $e) {
   // Rollback jika terjadi error
   mysqli_rollback($koneksi);
   $_SESSION['msg']['failed'] = "Terjadi kesalahan saat memproses data: " . $e->getMessage();
   header('location: ../../?page=transaksi-pinjam');
   exit();
}
