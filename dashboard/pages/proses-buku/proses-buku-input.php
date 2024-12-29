<?php 
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
$tmpName = $_FILES['cover']['tmp_name'];
$folder = 'image/';
$targetFolder = $folder.$cover;
move_uploaded_file($tmpName, $targetFolder);

session_start();

if($kode == ''){
    $_SESSION['msg']['err_kode'] = "Data kode tidak boleh kosong";
}

if($judul == ''){
    $_SESSION['msg']['err_judul'] = "Data judul tidak boleh kosong";
}

if($kategori == ''){
    $_SESSION['msg']['err_kategori'] = "Data kategori tidak boleh kosong";
}

if($penerbit == ''){
    $_SESSION['msg']['err_penerbit'] = "Data penerbit tidak boleh kosong";
}

if($isbn == ''){
    $_SESSION['msg']['err_isbn'] = "Data ISBN tidak boleh kosong";
}

if($penulis == ''){
    $_SESSION['msg']['err_penulis'] = "Data penerbit tidak boleh kosong";
}

if($tahun == ''){
    $_SESSION['msg']['err_tahun'] = "Data tahun terbit tidak boleh kosong";
}

// if($cover == ''){
//     $_SESSION['msg']['err_cover'] = "Data cover tidak boleh kosong";
// }

if($bahasa == ''){
    $_SESSION['msg']['err_bahasa'] = "Data bahasa tidak boleh kosong";
}

if($sinopsis == ''){
    $_SESSION['msg']['err_sinopsis'] = "Data sinopsis tidak boleh kosong";
}

if(isset($_SESSION['msg'])){
    header('location:../../?page=buku-input');
    exit();
}

include('../../components/koneksi.php');

$query = "SELECT * FROM buku WHERE kode='$kode' OR isbn='$isbn'";
$q = mysqli_query($koneksi, $query);
if(mysqli_num_rows($q)!=0){
    $_SESSION['msg']['error'] = "Data buku sudah ada, periksa kode atau isbn yang sama";
    header('location:../../../?page=buku-input');
    exit();
}

$query = "INSERT INTO buku VALUES ('$kode','$judul','$kategori', '$isbn', '$penulis', '$penerbit', '$tahun', '$cover', '$bahasa', '$sinopsis')";
mysqli_query($koneksi, $query);
$_SESSION['msg']['success'] = "Data buku baru berhasil di input";
header('location:../../?page=buku-input');