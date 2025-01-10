<?php
session_start();
include('../../components/koneksi.php');

if (!isset($_POST['btn-submit'])) {
   header('location: ../../?page=dashboard');
   exit();
}

// Ambil data dari form
$id = $_POST['id'];
$nik_anggota = $_POST['nik_anggota'];
$tgl_pinjam = $_POST['tgl_pinjam'];

// Ambil data buku dari form
$books = [];
for ($i = 1; $i <= 5; $i++) {
   $bookCode = isset($_POST["buku$i"]) ? $_POST["buku$i"] : '';  // Mengambil input dari form
   if (!empty($bookCode)) {
      $books[] = ['kode_buku' => $bookCode];
   }
}

// Simpan data form ke sesi untuk redisplay
$_SESSION['value'] = [
   'nik_anggota' => $nik_anggota,
   'tgl_pinjam' => $tgl_pinjam,
];
foreach ($books as $key => $book) {
   $_SESSION['value']["buku" . ($key + 1)] = $book['kode_buku'];
}

// Ambil data buku lama yang sudah ada di transaksi
$existingBooks = [];
$existingBooksQuery = "SELECT kode_buku FROM detail_transaksi WHERE id_transaksi='$id'";
$existingBooksResult = mysqli_query($koneksi, $existingBooksQuery);
while ($row = mysqli_fetch_assoc($existingBooksResult)) {
   $existingBooks[] = $row['kode_buku'];
}

// Filter buku baru
$newBooks = [];
foreach ($books as $book) {
   $bookCode = $book['kode_buku'];
   if (!in_array($bookCode, $existingBooks)) {
      $newBooks[] = $bookCode;
   }
}

// Validasi form
if (empty($books)) {
   $_SESSION['msg']['err-buku'] = "Tidak ada menambah peminjaman buku baru!";
} else {
   foreach ($books as $book) {
      $sql = "SELECT * FROM buku WHERE kode='{$book['kode_buku']}'";
      $query = mysqli_query($koneksi, $sql);
      if (mysqli_num_rows($query) == 0) {
         $_SESSION['msg']['err-buku'] = "Buku dengan kode '{$book['kode_buku']}' tidak ditemukan!";
      }
   }
}

// Validasi buku baru
if (empty($newBooks)) {
   $_SESSION['msg']['err-buku'] = "Tidak ada buku baru yang ditambahkan!";
}


//! Jika ada pesan error, kembalikan ke halaman sebelumnya
if (!empty($_SESSION['msg'])) {
   header('location: ../../?page=transaksi-tambah&id=' . $id);
   exit();
}

// Tambahkan buku baru ke transaksi
mysqli_autocommit($koneksi, false);
try {
   foreach ($newBooks as $bookCode) {
        $queryDetail = "INSERT INTO detail_transaksi (id, id_transaksi, nik_anggota, kode_buku) 
                        VALUES (NULL, '$id', '$nik_anggota', '$bookCode')";
        mysqli_query($koneksi, $queryDetail);
   }
   mysqli_commit($koneksi);
   $_SESSION['msg']['sukses'] = "Buku baru berhasil ditambahkan!";
} catch (Exception $e) {
   mysqli_rollback($koneksi);
   $_SESSION['msg']['failed'] = "Terjadi kesalahan saat menambahkan buku: " . $e->getMessage();
}
// Redirect ke halaman transaksi
header('location: ../../?page=transaksi-tambah&id=' . $id);
exit();