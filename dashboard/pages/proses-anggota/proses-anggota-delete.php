<?php

$nik = $_REQUEST['nik'];

include('../../components/koneksi.php');

// Ambil nama file gambar dari database sebelum menghapus data
$sql = "SELECT foto FROM anggota WHERE nik='$nik'";
$query = mysqli_query($koneksi, $sql);
$data = mysqli_fetch_array($query);
$filePath = 'image/' . $data['foto']; // Path file gambar
unlink($filePath); // Menghapus file gambar dari folder

$query = "DELETE FROM anggota WHERE nik='$nik'";
mysqli_query($koneksi, $query);
session_start();
$_SESSION['msg']['success'] = "Data anggota " . $nik . " berhasil dihapus";
header('location:../../?page=anggota-data');