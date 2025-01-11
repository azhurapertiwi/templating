<?php
session_start();
include('../dashboard/components/koneksi.php');
$sql = "SELECT * FROM buku
         LEFT JOIN kategori ON buku.kategori_kode = kategori.kategori_kode
         LEFT JOIN penerbit ON buku.penerbit_kode = penerbit.penerbit_kode
         ORDER BY buku.judul ASC";
$query = mysqli_query($koneksi, $sql);

if (isset($_POST['cari'])) {
   $judul = $_POST ['judul-buku'];

   $_SESSION['value-judul'] = $judul;

   $sql = "SELECT * FROM buku
         LEFT JOIN kategori ON buku.kategori_kode = kategori.kategori_kode
         LEFT JOIN penerbit ON buku.penerbit_kode = penerbit.penerbit_kode
         WHERE judul LIKE '%$judul%' ORDER BY buku.judul ASC";
   $query = mysqli_query($koneksi, $sql);
   if (mysqli_num_rows($query) == 0) {
      $_SESSION['err-cari'] = '<h1 class="text-center bg-warning py-5">Buku tidak ditemukan</h1>';
   }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Perpustakaan</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="../assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>
</head>

<body>
    <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
        id="layout-navbar">
        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
            </a>
        </div>

        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <!-- Search -->
            <form action="" method="POST">
                <div class="navbar-nav align-items-center">
                    <div class="nav-item d-flex align-items-center border">
                        <i class="bx bx-search fs-4 lh-0"></i>
                        <input type="text" class="form-control border-0 shadow-none" placeholder="Cari Buku"
                            aria-label="Search..." name="judul-buku"
                            value="<?= (isset($_SESSION['judul'])) ? $_SESSION['judul'] : null;?>" />
                        <button class="btn btn-outline-primary" type="submit" name="cari">Search</button>
                    </div>
                </div>
            </form>
            <!-- /Search -->

            <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- Place this tag where you want the button to render. -->
                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                        <div class="avatar avatar-online">
                            <img src="../assets/img/avatars/6.png" alt class="w-px-40 h-auto rounded-circle" />
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="../login/login.php">
                                <i class="bx bx-power-off"></i>
                                <span class="align-middle">Log In</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!--/ User -->
            </ul>
        </div>
    </nav>

    <!-- Card Groups -->
    <div class="content-wrapper min-vh-100">
        <div class="container-xxl flex-grow-1 container-p-y">

            <div class="row mb-10">
                <div class="col-md mb-10">
                    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-bs-target="#carouselExample" data-bs-slide-to="0" class="active"></li>
                            <li data-bs-target="#carouselExample" data-bs-slide-to="1"></li>
                            <li data-bs-target="#carouselExample" data-bs-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="../assets/img/elements/background1.jpg"
                                    alt="First slide" style="max-height: 400px;" />
                                <div class="carousel-caption d-none d-md-block">
                                    <h3>Perpustakaan</h3>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="../assets/img/elements/background2.jpg"
                                    alt="Second slide" style="max-height: 400px;" />
                                <div class="carousel-caption d-none d-md-block">
                                    <h3>Perpustakaan</h3>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="../assets/img/elements/background3.jpg"
                                    alt="Third slide" style="max-height: 400px;" />
                                <div class="carousel-caption d-none d-md-block">
                                    <h3>Perpustakaan</h3>
                                </div>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExample" role="button" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExample" role="button" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-xxl flex-grow-1 container-p-y">
            <!-- Content Carousel -->
            <!-- Content Card -->
            <div class="row mb-12 g-6">
                <?php while ($data = mysqli_fetch_array($query)) { ?>
                <div class="col-md-6 col-xl-4">
                    <div class="card mb-3">
                        <img class="card-img-top"
                            src="../dashboard/pages/proses-buku/image/<?php echo $data['cover']; ?>"
                            alt="Card image cap" />
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $data['judul']; ?></h5>
                            <p class="card-text">
                                <?php echo $data['sinopsis']; ?>
                            </p>
                            <a class="btn btn-primary" href="detail.php?kode=<?= $data['kode'] ?>">lihat detail</a>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- build:js assets/vendor/js/core.js -->
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="../assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>