<?php
session_start();
include('../../components/koneksi.php');

if (!isset($_POST['btn-submit'])) {
    header('location:../../index.php');
}

$nik = $_POST['nik'];
$nama = $_POST['nama'];
$no_hp = $_POST['no_hp'];
$email = $_POST['email'];
$alamat = $_POST['alamat'];

$foto = $_FILES['foto']['name'];
$fileTmp = $_FILES['foto']['tmp_name'];
$folder = 'image/';

// ekstensi gambar
$ekstensiValid = ['jpg', 'jpeg', 'png'];
$ekstensiFile = strtolower(pathinfo($foto, PATHINFO_EXTENSION));
$ekstensiGambar = explode('.', $foto);
$ekstensiGambar = end($ekstensiGambar);

// fungsi waktu
$foto = date('l, d-m-Y  H:i:s');

// generate nama baru
$namaBaru = strtolower(md5($foto) . '.' . $ekstensiGambar);

$sql = "SELECT foto FROM anggota WHERE nik='$nik'";
$query = mysqli_query($koneksi, $sql);
$data = mysqli_fetch_array($query);
$oldFile = $data['foto'];
$filePath = $folder . $oldFile;

// Cek apakah file gambar baru diupload
if ($_FILES['foto']['name']) {
    // Jika gambar baru diupload, hapus gambar lama
    if (file_exists($filePath)) {
        unlink($filePath);  // Hapus gambar lama
    }

    // Pindahkan gambar baru ke folder
    $upload = move_uploaded_file($fileTmp, $folder . $namaBaru);

    // Update nama gambar baru di database
    if ($upload) {
        $sql = "UPDATE anggota SET foto='$namaBaru' WHERE nik='$nik'";
        mysqli_query($koneksi, $sql);
    }
}

if ($nik == '') {
    $_SESSION['msg']['err_nik'] = "Data nik tidak boleh kosong";
}

if ($nama == '') {
    $_SESSION['msg']['err_nama'] = "Data nama tidak boleh kosong";
}

if ($no_hp == '') {
    $_SESSION['msg']['err_no_hp'] = "Data no_hp tidak boleh kosong";
}

if ($email == '') {
    $_SESSION['msg']['err_email'] = "Data email tidak boleh kosong";
}

if ($alamat == '') {
    $_SESSION['msg']['err_alamat'] = "Data alamat tidak boleh kosong";
}

if ($namaBaru) {
    header('location: ../../?page=buku-data');
} else if ($foto == '') {
    $_SESSION['msg']['foto'] = "Pilih Gambar!";
} else if (!$upload) {
    $_SESSION['msg']['foto'] = "Gagal meng-upload file.";
    header('location: ../../?page=buku-input-update&nik=' . $nik);
}

if (isset($_SESSION['msg']['err_nik']) || isset($_SESSION['msg']['err_nama']) || isset($_SESSION['msg']['err_no_hp']) || isset($_SESSION['msg']['err_email']) || isset($_SESSION['msg']['err_alamat']) || isset($_SESSION['msg']['err_foto'])) {
    header('location:../../?page=anggota-input-update&nik=' . $nik);
    exit();
}

$query = "SELECT * FROM anggota WHERE email='$email' AND nik != '$nik'";
$q = mysqli_query($koneksi, $query);
if (mysqli_num_rows($q) != 0) {
    $_SESSION['msg']['error'] = "Data anggota sudah ada, periksa email yang sama";
    header('location:../../?page=anggota-input-update&nik=' . $nik);
    exit();
}

$query = "UPDATE anggota SET nama='$nama', no_hp='$no_hp', email='$email', alamat='$alamat' WHERE nik='$nik'";
mysqli_query($koneksi, $query);
$_SESSION['msg']['success'] = "Data anggota berhasil diupdate";
header('location:../../?page=anggota-data');
