<?php 

$kode = $_REQUEST['kode'];

include('../../components/koneksi.php');

$query = "DELETE FROM anggota WHERE kode='$kode'";
mysqli_query($koneksi, $query);
session_start();
$_SESSION['msg']['success'] = "Data anggota ".$kode." berhasil dihapus";
header('location:../../?page=anggota-data');