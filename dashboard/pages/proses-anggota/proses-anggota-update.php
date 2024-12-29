<?php 
if (!isset($_POST['btn-submit'])) {
    header('location:../../index.php');
}

$nik = $_POST['nik'];
$nama = $_POST['nama'];
$no_hp = $_POST['no_hp'];
$email = $_POST['email'];
$alamat = $_POST['alamat'];
$foto = $_POST['foto'];

session_start();

if($nik == ''){
    $_SESSION['msg']['err_nik'] = "Data nik tidak boleh kosong";
}

if($nama == ''){
    $_SESSION['msg']['err_nama'] = "Data nama tidak boleh kosong";
}

if($no_hp == ''){
    $_SESSION['msg']['err_no_hp'] = "Data no_hp tidak boleh kosong";
}

if($email == ''){
    $_SESSION['msg']['err_email'] = "Data email tidak boleh kosong";
}

if($alamat == ''){
    $_SESSION['msg']['err_alamat'] = "Data alamat tidak boleh kosong";
}

if($foto == ''){
    $_SESSION['msg']['err_foto'] = "Data foto tidak boleh kosong";
}

if(isset($_SESSION['msg']['err_nik']) || isset($_SESSION['msg']['err_nama']) || isset($_SESSION['msg']['err_no_hp']) || isset($_SESSION['msg']['err_email']) || isset($_SESSION['msg']['err_alamat']) || isset($_SESSION['msg']['err_foto'])){
    header('location:../../?page=anggota-input');
    exit();
}

include('../../components/koneksi.php');

$query = "SELECT * FROM anggota WHERE nama='$nama' AND kode != 'kode'";
$q = mysqli_query($koneksi, $query);
if(mysqli_num_rows($q)!=0){
    $_SESSION['msg']['error'] = "Data anggota sudah ada, periksa kode atau nama yang sama";
    header('location:../../?page=anggota-input-update&kode='.$kode);
    exit();
}

$query = "UPDATE anggota SET nama='$nama', alamat='$alamat' WHERE kode='$kode'";
mysqli_query($koneksi, $query);
$_SESSION['msg']['success'] = "Data anggota berhasil diupdate";
header('location:../../?page=anggota-data');