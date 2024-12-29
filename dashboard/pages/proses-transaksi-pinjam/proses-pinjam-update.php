<?php 
if (!isset($_POST['btn-submit'])) {
    header('location:../../index.php');
}

$kode = $_POST['kode'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];

session_start();

if($nama == ''){
    $_SESSION['msg']['err_nama'] = "Data nama tidak boleh kosong";
}

if($nama == ''){
    $_SESSION['msg']['err_alamat'] = "Data alamat tidak boleh kosong";
}

if(isset($_SESSION['msg']['err_nama'])||isset($_SESSION['msg']['err_alamat'])){
    header('location:../../?page=transaksi_pinjam-input-update&kode='.$kode);
    exit();
}

include('../../components/koneksi.php');

$query = "SELECT * FROM transaksi_pinjam WHERE nama='$nama' AND kode != 'kode'";
$q = mysqli_query($koneksi, $query);
if(mysqli_num_rows($q)!=0){
    $_SESSION['msg']['error'] = "Data transaksi_pinjam sudah ada, periksa kode atau nama yang sama";
    header('location:../../?page=transaksi_pinjam-input-update&kode='.$kode);
    exit();
}

$query = "UPDATE transaksi_pinjam SET nama='$nama', alamat='$alamat' WHERE kode='$kode'";
mysqli_query($koneksi, $query);
$_SESSION['msg']['success'] = "Data transaksi_pinjam berhasil diupdate";
header('location:../../?page=transaksi_pinjam-data');