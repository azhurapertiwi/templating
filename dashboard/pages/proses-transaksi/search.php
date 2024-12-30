<?php
// Memulai sesi dan memastikan koneksi database
session_start();
include('../../components/koneksi.php');

// Mengecek apakah parameter 'q' ada
if (isset($_GET['q'])) {
    $nik = $_GET['q'];

    // Query untuk mencari nama berdasarkan NIK
    $sql = "SELECT nama FROM anggota WHERE nik = '$nik' LIMIT 1";
    $query = mysqli_query($koneksi, $sql);

    if (mysqli_num_rows($query) > 0) {
        // Menampilkan nama jika NIK ditemukan
        $data = mysqli_fetch_array($query);
        echo $data['nama'];
    } else {
        // Menampilkan pesan jika NIK tidak ditemukan
        echo "Tidak ada data anggota berdasarkan NIK ini!";
    }
}

if (isset($_GET['b'])) {
    $kode = $_GET['b'];

    $sql = "SELECT judul FROM buku WHERE kode = '$kode' LIMIT 1";
    $query = mysqli_query($koneksi, $sql);

    if (mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_array($query);
        echo $data['judul'];
    } else {
        echo "Tidak ada data buku berdasarkan kode ini!";
    }
}

mysqli_close($koneksi);
