<?php

$nik = $_REQUEST['nik'];

include('../../components/koneksi.php');

$query = "DELETE FROM anggota WHERE nik='$nik'";
mysqli_query($koneksi, $query);
session_start();
$_SESSION['msg']['success'] = "Data anggota " . $nik . " berhasil dihapus";
header('location:../../?page=anggota-data');
