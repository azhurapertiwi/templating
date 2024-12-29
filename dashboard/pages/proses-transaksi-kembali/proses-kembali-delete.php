<?php 

$kode = $_REQUEST['kode'];

include('../../components/koneksi.php');

$query = "DELETE FROM transaksi_kembali WHERE kode='$kode'";
mysqli_query($koneksi, $query);
session_start();
$_SESSION['msg']['success'] = "Data transaksi_kembali ".$kode." berhasil dihapus";
header('location:../../?page=transaksi_kembali-data');