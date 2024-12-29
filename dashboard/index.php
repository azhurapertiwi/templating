<?php 
session_start();
if (!isset($_SESSION['login'])){
   header('location: ../login.php');
   exit();
}
?>

<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="assets/"
    data-template="vertical-menu-template-free">

<head>
    <?php include('components/style.php'); ?>
</head>

<body>
    <?php
   $page = isset($_REQUEST['page']) && !empty($_REQUEST['page']) ? $_REQUEST['page'] : 'dashboard';
   $page_path = 'pages/'. $page. '.php';  // Replace 'dashboard' with your actual page name

   if (file_exists($page_path)) { 
   ?>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <?php  include('components/sidebar.php');?>

            <div class="layout-page">
                <?php include('components/navbar.php');?>
                <div class="content-wrapper">
                    <?php include($page_path); ?>
                    <!-- Footer -->
                    <?php include ('components/footer.php');?>
                </div>
            </div>
        </div>
        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <?php }
    ?>
    <!-- Core JS -->
    <?php include('components/script.php'); ?>
</body>

</html>