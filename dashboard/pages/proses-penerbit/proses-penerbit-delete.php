<?php 

$kode = $_REQUEST['kode'];

include('../../components/koneksi.php');

$query = "DELETE FROM penerbit WHERE penerbit_kode='$kode'";
mysqli_query($koneksi, $query);
session_start();
$_SESSION['msg']['success'] = "Data penerbit ".$kode." berhasil dihapus";
header('location:../../?page=penerbit-data');