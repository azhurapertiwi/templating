<?php 
session_start();
include('../../components/koneksi.php');

if (!isset($_POST['btn-submit'])) {
    header('location:../../index.php');
}

$nik = $_POST['nik'];
$nama = $_POST['nama'];
$nomor_hp = $_POST['nomor_hp'];
$email = $_POST['email'];
$alamat = $_POST['alamat'];

// insert gambar ke db dan folder image
$foto = $_FILES['foto']['nama'];
$fileTmp = $_FILES['foto']['tmp_name'];
$folder = 'image/';

$ekstensiValid = ['jpg', 'jpeg', 'png'];
$ekstensiFile = strtolower(pathinfo($foto, PATHINFO_EXTENSION));
$ekstensiGambar = explode('.', $foto);
$ekstensiGambar = end($ekstensiGambar);

// fungsi waktu
$foto = date('l, d-m-Y  H:i:s');

// generate nama baru
$newnama = strtolower(md5($foto).'.'.$ekstensiGambar);
$upload = move_uploaded_file($fileTmp, $folder.$newnama);

// value
$_SESSION['value']['nik'] = $nik;
$_SESSION['value']['nama'] = $nama;
$_SESSION['value']['nomor_hp'] = $nomor_hp;
$_SESSION['value']['email'] = $email;
$_SESSION['value']['alamat'] = $alamat;
$_SESSION['value']['foto'] = $foto;

if($nik == ''){
    $_SESSION['msg']['nik'] = "Data nik tidak boleh kosong";
}

if($nama == ''){
    $_SESSION['msg']['nama'] = "Data nama tidak boleh kosong";
}

if($nomor_hp == ''){
    $_SESSION['msg']['nomor_hp'] = "Data nomor hp tidak boleh kosong";
}

if($email == ''){
    $_SESSION['msg']['email'] = "Data email tidak boleh kosong";
}

if($alamat == ''){
    $_SESSION['msg']['alamat'] = "Data alamat tidak boleh kosong";
}

if($foto == ''){
    $_SESSION['msg']['foto'] = "Data foto tidak boleh kosong";  
}

if(isset($_SESSION['msg'])){
    header('location:../../?page=anggota-input');
    exit();
}


$sql = "SELECT * FROM anggota WHERE nik='$nik' OR no_hp='$nomor_hp' OR email='$email'";
$query = mysqli_query($koneksi, $sql);
if (mysqli_num_rows($query) != 0) {
   $_SESSION['msg']['failed'] = "Data anggota sudah ada, periksa kembali nomor telepon atau alamat email!";
   header('location: ../../?page=anggota-input');
   exit();
}

$sql = "INSERT INTO anggota VALUES ('$nik', '$nama', '$nomor_hp', '$email', '$alamat', '$newnama')";
$query = mysqli_query($koneksi, $sql);
$_SESSION['msg']['anggota'] = "Data anggota baru berhasil ditambahkan!";
header('location: ../../?page=anggota-input');
unset($_SESSION['value']);