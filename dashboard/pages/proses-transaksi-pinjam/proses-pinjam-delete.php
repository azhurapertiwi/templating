<?php 

$kode = $_REQUEST['kode'];

include('../../components/koneksi.php');

$query = "DELETE FROM transaksi_pinjam WHERE kode='$kode'";
mysqli_query($koneksi, $query);
session_start();
$_SESSION['msg']['success'] = "Data transaksi_pinjam ".$kode." berhasil dihapus";
header('location:../../?page=transaksi_pinjam-data');