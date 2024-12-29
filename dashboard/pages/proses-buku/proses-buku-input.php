<?php
session_start();
include('../../components/koneksi.php');

if (!isset($_POST['btn-submit'])) {
    header('location:../../index.php');
}

$kode = $_POST['kode'];
$judul = $_POST['judul'];
$kategori = $_POST['kategori'];
$isbn = $_POST['isbn'];
$penerbit = $_POST['penerbit'];
$penulis = $_POST['penulis'];
$tahun = $_POST['tahun'];
$bahasa = $_POST['bahasa'];
$sinopsis = $_POST['sinopsis'];

$cover = $_FILES['cover']['name'];
$fileTmp = $_FILES['cover']['tmp_name'];
$folder = 'image/';

$ekstensiValid = ['jpg', 'jpeg', 'png'];
$ekstensiFile = strtolower(pathinfo($cover, PATHINFO_EXTENSION));
$ekstensiGambar = explode('.', $cover);
$ekstensiGambar = end($ekstensiGambar);

// fungsi waktu
$cover = date('l, d-m-Y  H:i:s');

// generate nama baru
$namaBaru = strtolower(md5($cover) . '.' . $ekstensiGambar);
$upload = move_uploaded_file($fileTmp, $folder . $namaBaru);

if ($kode == '') {
    $_SESSION['msg']['err_kode'] = "Data kode tidak boleh kosong";
}

if ($judul == '') {
    $_SESSION['msg']['err_judul'] = "Data judul tidak boleh kosong";
}

if ($kategori == '') {
    $_SESSION['msg']['err_kategori'] = "Data kategori tidak boleh kosong";
}

if ($penerbit == '') {
    $_SESSION['msg']['err_penerbit'] = "Data penerbit tidak boleh kosong";
}

if ($isbn == '') {
    $_SESSION['msg']['err_isbn'] = "Data ISBN tidak boleh kosong";
}

if ($penulis == '') {
    $_SESSION['msg']['err_penulis'] = "Data penerbit tidak boleh kosong";
}

if ($tahun == '') {
    $_SESSION['msg']['err_tahun'] = "Data tahun terbit tidak boleh kosong";
}

if (!$upload) {
    $_SESSION['msg']['err_cover'] = "Pilih gambar";
}

if ($bahasa == '') {
    $_SESSION['msg']['err_bahasa'] = "Data bahasa tidak boleh kosong";
}

if ($sinopsis == '') {
    $_SESSION['msg']['err_sinopsis'] = "Data sinopsis tidak boleh kosong";
}

if (isset($_SESSION['msg'])) {
    header('location: ../../?page=buku-input');
    exit();
}

$query = "SELECT * FROM buku WHERE kode='$kode' OR isbn='$isbn'";
$q = mysqli_query($koneksi, $query);
if (mysqli_num_rows($q) != 0) {
    $_SESSION['msg']['error'] = "Data buku sudah ada, periksa kode atau isbn yang sama";
    header('location: ../../?page=buku-input');
    exit();
}

$query = "INSERT INTO buku VALUES ('$kode','$judul','$kategori', '$isbn', '$penulis', '$penerbit', '$tahun', '$namaBaru', '$bahasa', '$sinopsis')";
mysqli_query($koneksi, $query);
$_SESSION['msg']['success'] = "Data buku baru berhasil di input";
header('location: ../../?page=buku-input');
