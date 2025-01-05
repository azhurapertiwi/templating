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
$penulis = $_POST['penulis'];
$penerbit = $_POST['penerbit'];
$tahun = $_POST['tahun'];
$bahasa = $_POST['bahasa'];
$sinopsis = $_POST['sinopsis'];

// update gambar
$cover = $_FILES['cover']['name'];
$fileTmp = $_FILES['cover']['tmp_name'];
$folder = 'image/';

// ekstensi gambar
$ekstensiValid = ['jpg', 'jpeg', 'png'];
$ekstensiFile = strtolower(pathinfo($cover, PATHINFO_EXTENSION));
$ekstensiGambar = explode('.', $cover);
$ekstensiGambar = end($ekstensiGambar);

// fungsi waktu
$cover = date('l, d-m-Y  H:i:s');

// generate nama baru
$namaBaru = strtolower(md5($cover) . '.' . $ekstensiGambar);

$sql = "SELECT cover FROM buku WHERE kode='$kode'";
$query = mysqli_query($koneksi, $sql);
$data = mysqli_fetch_array($query);
$oldFile = $data['cover'];
$filePath = $folder . $oldFile;

// Cek apakah file gambar baru diupload
if ($_FILES['cover']['name']) {
    // Jika gambar baru diupload, hapus gambar lama
    if (file_exists($filePath)) {
        unlink($filePath);  // Hapus gambar lama
    }

    // Pindahkan gambar baru ke folder
    $upload = move_uploaded_file($fileTmp, $folder . $namaBaru);

    // Update nama gambar baru di database
    if ($upload) {
        $sql = "UPDATE buku SET cover='$namaBaru' WHERE kode='$kode'";
        mysqli_query($koneksi, $sql);
    }
}


if ($kode == '') {
    $_SESSION['msg']['kode'] = "Data kode tidak boleh kosong";
}

if ($judul == '') {
    $_SESSION['msg']['judul'] = "Data judul tidak boleh kosong";
}

if ($kategori == '') {
    $_SESSION['msg']['kategori'] = "Data kategori tidak boleh kosong";
}

if ($isbn == '') {
    $_SESSION['msg']['isbn'] = "Data ISBN tidak boleh kosong";
}

if ($penulis == '') {
    $_SESSION['msg']['penulis'] = "Data penulis tidak boleh kosong";
}

if ($penulis == '') {
    $_SESSION['msg']['penerbit'] = "Data penerbit tidak boleh kosong";
}

if ($tahun == '') {
    $_SESSION['msg']['tahun'] = "Data tahun terbit tidak boleh kosong";
}

// validasi; jika ada gambar baru maka berhasil
if ($namaBaru) {
    header('location: ../../?page=buku-data');
} else if ($cover == '') {
    $_SESSION['msg']['cover'] = "Pilih Gambar!";
} else if (!$upload) {
    $_SESSION['msg']['cover'] = "Gagal meng-upload file.";
    header('location: ../../?page=buku-input-update&kode=' . $kode);
}

if ($bahasa == '') {
    $_SESSION['msg']['bahasa'] = "Data bahasa tidak boleh kosong";
}

if ($sinopsis == '') {
    $_SESSION['msg']['sinopsis'] = "Data sinopsis tidak boleh kosong";
}


if (isset($_SESSION['msg'])) {
    header('location:../../?page=buku-input-update&kode=' . $kode);
    exit();
}


$query = "SELECT * FROM buku WHERE judul='$judul' AND isbn!='$isbn' AND kode!='$kode'";
$q = mysqli_query($koneksi, $query);
if (mysqli_num_rows($q) != 0) {
    $_SESSION['msg']['error'] = "Data buku sudah ada, periksa isbn yang sama";
    header('location:../../?page=buku-input-update&kode=' . $kode);
    exit();
}

$query = "UPDATE buku SET judul='$judul', kategori_kode='$kategori', isbn='$isbn', penulis='$penulis', penerbit_kode='$penerbit', tahun='$tahun', bahasa='$bahasa', sinopsis='$sinopsis' WHERE kode='$kode'";
mysqli_query($koneksi, $query);
$_SESSION['msg']['success'] = "Data buku berhasil diupdate";
header('location:../../?page=buku-data');