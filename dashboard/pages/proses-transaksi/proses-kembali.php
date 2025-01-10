<?php
session_start();
include('../../components/koneksi.php');

if (!isset($_POST['btn-submit'])) {
    header('location: ../../index.php');
    exit();
}

$nik_anggota = $_POST['nik_anggota'];
$tgl_kembali = $_POST['tgl_kembali'];

// validasi jika anggota tidak ada
$sql = "SELECT * FROM anggota WHERE nik='$nik_anggota'";
$query = mysqli_query($koneksi, $sql);
$data = mysqli_num_rows($query);

if ($nik_anggota == '') {
    $_SESSION['msg']['nik_anggota'] = "Tidak ada NIK yang dicari!";
} else if ($data == 0) {
    $_SESSION['msg']['nik_anggota'] = '';
}

if ($tgl_kembali == '') {
    $_SESSION['msg']['tgl_kembali'] = "Isi tanggal pengembalian!";
}
if (isset($_SESSION['msg'])) {
    header('location: ../../?page=transaksi-kembali');
    exit();
}

// Mulai transaksi
mysqli_autocommit($koneksi, false); // Mulai transaksi untuk konsistensi data

try {
    // 1. Cek apakah ada transaksi yang tgl_kembali nya NULL untuk satu member
    $sqlCheckReturn = "SELECT tgl_kembali FROM transaksi WHERE nik_anggota='$nik_anggota'";
    $queryCheckReturn = mysqli_query($koneksi, $sqlCheckReturn);
    if (!$queryCheckReturn) {
       throw new Exception("Gagal mengecek status pengembalian buku: " . mysqli_error($koneksi));
    }
 
    $nullTglKembali = false; // Menandakan apakah masih ada transaksi dengan tgl_kembali NULL
    $validTglKembali = false; // Menandakan apakah semua transaksi sudah memiliki tgl_kembali yang valid
 
    // Periksa seluruh transaksi member
    while ($dataReturn = mysqli_fetch_array($queryCheckReturn)) {
       if ($dataReturn['tgl_kembali'] == NULL) {
          // Jika ada transaksi dengan tgl_kembali NULL, berarti member masih bisa mengembalikan buku
          $nullTglKembali = true;
       } else {
          // Jika ada transaksi dengan tgl_kembali yang sudah terisi (valid), berarti member sudah mengembalikan buku
          $validTglKembali = true;
       }
    }
 
    // 2. Jika masih ada transaksi dengan tgl_kembali NULL, maka member bisa mengembalikan buku
    if ($nullTglKembali) {
       // Update tgl_kembali pada transaksi yang belum dikembalikan
       $sqlUpdateTransaksi = "UPDATE transaksi SET tgl_kembali='$tgl_kembali' WHERE nik_anggota='$nik_anggota' AND tgl_kembali IS NULL";
       $queryUpdateTransaksi = mysqli_query($koneksi, $sqlUpdateTransaksi);
       if (!$queryUpdateTransaksi) {
          throw new Exception("Gagal mengupdate tgl_kembali: " . mysqli_error($koneksi));
       }
 
       // Commit transaksi
       mysqli_commit($koneksi);
 
       // Set pesan sukses
       $_SESSION['msg']['sukses'] = "Buku peminjaman <b>" . $nik_anggota . "</b> berhasil dikembalikan!";
       unset($_SESSION['value']);
       header('location: ../../?page=transaksi-data');
       exit();
    } else {
       // Jika tidak ada transaksi dengan tgl_kembali NULL, maka member sudah mengembalikan semua bukunya
       $_SESSION['msg']['failed'] = "Tidak ada peminjaman buku dari Anggota ini!";
       header('location: ../../?page=transaksi-kembali');
       exit();
    }
 
} catch (Exception $e) {
    // Rollback jika terjadi error
    mysqli_rollback($koneksi);
    $_SESSION['msg']['failed'] = "Terjadi kesalahan saat memproses data: " . $e->getMessage();
    header('location: ../../?page=transaksi-kembali');
    exit();
}
 