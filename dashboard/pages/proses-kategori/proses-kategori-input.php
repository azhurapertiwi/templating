<?php 
if (!isset($_POST['btn-submit'])) {
    header('location:../../?page=dashboard');
}

$kode = $_POST['kode'];
$nama = $_POST['nama'];

session_start();

if($kode == ''){
    $_SESSION['msg']['err_kode'] = "Data kode tidak boleh kosong";
}

if($nama == ''){
    $_SESSION['msg']['err_nama'] = "Data nama tidak boleh kosong";
}

if(isset($_SESSION['msg'])){
    header('location:../../?page=kategori-input');
    exit();
}

include('../../components/koneksi.php');

$query = "SELECT * FROM kategori WHERE kategori_kode='$kode' OR kategori_nama='$nama'";
$q = mysqli_query($koneksi, $query);
if(mysqli_num_rows($q)!=0){
    $_SESSION['msg']['error'] = "Data kategori sudah ada, periksa kode atau nama yang sama";
    header('location: ../../?page=kategori-input');
    exit();
}

$query = "INSERT INTO kategori VALUES('$kode','$nama')";
mysqli_query($koneksi, $query);
$_SESSION['msg']['success'] = "Data kategori baru berhasil di input";
header('location: ../../?page=kategori-input');