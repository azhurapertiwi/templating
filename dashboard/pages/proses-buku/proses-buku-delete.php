<?php
// Ambil kode buku yang akan dihapus dari parameter URL
$kode = $_REQUEST['kode'];

include('../../components/koneksi.php');

// Ambil nama file gambar dari database sebelum menghapus data
$sql = "SELECT cover FROM buku WHERE kode='$kode'";
$query = mysqli_query($koneksi, $sql);
$data = mysqli_fetch_array($query);
$filePath = 'image/' . $data['cover']; // Path file gambar
unlink($filePath); // Menghapus file gambar dari folder

$sql = "DELETE FROM buku WHERE kode='$kode'";
$query = mysqli_query($koneksi, $sql);

session_start();
$_SESSION['msg']['success'] = "Data buku <b>'" . $kode . "</b>' berhasil dihapus !";
header('location: ../../?page=buku-data');
