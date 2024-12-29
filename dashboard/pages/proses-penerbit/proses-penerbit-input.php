<?php 
if (!isset($_POST['btn-submit'])) {
    header('location:../../index.php');
}

$kode = $_POST['kode'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];

session_start();

if($kode == ''){
    $_SESSION['msg']['err_kode'] = "Data kode tidak boleh kosong";
}

if($nama == ''){
    $_SESSION['msg']['err_nama'] = "Data nama tidak boleh kosong";
}

if($alamat == ''){
    $_SESSION['msg']['err_alamat'] = "Data alamat tidak boleh kosong";
}

if(isset($_SESSION['msg']['err_kode']) || isset($_SESSION['msg']['err_nama']) || isset($_SESSION['msg']['err_alamat'])){
    header('location:../../?page=penerbit-input');
    exit();
}

include('../../components/koneksi.php');

$query = "SELECT * FROM penerbit WHERE penerbit_kode='$kode' OR penerbit_nama='$nama'";
$q = mysqli_query($koneksi, $query);
if(mysqli_num_rows($q)!=0){
    $_SESSION['msg']['error'] = "Data penerbit sudah ada, periksa kode atau nama yang sama";
    header('location:../../?page=penerbit-input');
    exit();
}

$query = "INSERT INTO penerbit VALUES('$kode','$nama','$alamat')";
mysqli_query($koneksi, $query);
$_SESSION['msg']['success'] = "Data penerbit baru berhasil di input";
header('location:../../?page=penerbit-input');