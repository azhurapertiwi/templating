<?php 

if(!isset($_POST['btn-register'])){
    header('location:login.php');
    exit();
}
// proses register
// ============
// ambil username dan password yg diinput
$name_form = $_POST['name'];
$phonenumber_form = $_POST['phonenumber'];
$email_form = $_POST['email'];
$user_form = $_POST['username'];
$pass_form = $_POST['password'];
$pass_conf = $_POST['password_confirmation'];
// validasi kosong atau tidak
session_start();
if($user_form==''){
    $_SESSION['msg-name'] = "Nama tidak boleh kosong.";
}
if($pass_form==''){
    $_SESSION['msg-phonenumber'] = "No HP tidak boleh kosong.";
}
if($pass_conf==''){
    $_SESSION['msg-email'] = "Email tidak boleh kosong.";
}
if($pass_conf==''){
    $_SESSION['msg-user'] = "Username tidak boleh kosong.";
}
if($pass_conf==''){
    $_SESSION['msg-pass'] = "Password tidak boleh kosong.";
}
if($pass_conf==''){
    $_SESSION['msg-pass-conf'] = "Password Confirmation tidak boleh kosong.";
}

if(
    isset($_SESSION['msg-name']) || 
    isset($_SESSION['msg-phonenumber']) || 
    isset($_SESSION['msg-email']) ||
    isset($_SESSION['msg-user']) || 
    isset($_SESSION['msg-pass']) || 
    isset($_SESSION['msg-pass-conf']))
{
    $_SESSION['name_cache'] = $user_form;
    header('location:register.php');
    exit();
}

if($pass_form != $pass_conf){
    $_SESSION['username_cache'] = $user_form;
    $_SESSION['msg-pass-conf'] = "Confirmation password tidak sama.";
    header('location:register.php');
    exit();
}

$conn = mysqli_connect('localhost', 'root', '', '2024sem5_sore');
$sql = "SELECT * FROM users WHERE username='$user_form'";
$q = mysqli_query($conn, $sql);
$numRow = mysqli_num_rows($q);

if($numRow > 0){
    $_SESSION['msg-global'] = "Username sudah ada.";
    header('location:register.php');
    exit();
}

// register
$sql = "INSERT INTO users (id, username, password) VALUES(null, '$user_form', '$pass_form')";
mysqli_query($conn, $sql);
header('location:form.php');

?>