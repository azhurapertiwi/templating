<?php
if (isset($_REQUEST['kode'])) {
  $kode = $_REQUEST['kode'];
  include('../dashboard/components/koneksi.php');
  $sql = "SELECT * FROM buku
         LEFT JOIN kategori ON buku.kategori_kode = kategori.kategori_kode
         LEFT JOIN penerbit ON buku.penerbit_kode = penerbit.penerbit_kode
         WHERE kode = '$kode'
         ORDER BY buku.judul ASC";
$query = mysqli_query($koneksi, $sql);
$data = mysqli_fetch_array($query);
}
?>
<!-- Modal -->
<!DOCTYPE html>

<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Modals - UI elements | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>
  </head>

  <body>


          <!-- Content wrapper -->
          <div class="content-wrapper h-100">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <!-- Bootstrap modals -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row gy-3">
                            <!-- Fullscreen Modal -->
                            <div class="modal-header">
                                <h3 class="modal-title" id="modalFullTitle">DETAIL BUKU</h3>
                            </div>
                            <div class="mt-3 d-flex">
                                <img src="../dashboard/pages/proses-buku/image/<?= $data['cover']; ?>" alt=""
                                style="width:40%; height:75vh;">
                                <div class="modal-body">
                                    <h5>JUDUL : <?= $data['judul']; ?></h5>
                                    <h5>KATEGORI : <?= $data['kategori_nama']; ?></h5>
                                    <h5>ISBN : <?= $data['isbn']; ?></h5>
                                    <h5>PENULIS : <?= $data['penulis']; ?></h5>
                                    <h5>PENERBIT : <?= $data['penerbit_nama']; ?></h5>
                                    <h5>TANGGAL : <?= $data['tahun']; ?></h5>
                                    <h5>BAHASA : <?= $data['bahasa']; ?></h5>
                                    <h5>SINOPSIS : <?= $data['sinopsis']; ?></h5>
                                </div>
                            </div>
                            <div class="modal-footer">
                            <a class="btn btn-primary" href="index.php">CLOSE</a>
                            </div>
                        </div>
                    </div>
                </div>
              <!--/ Bootstrap modals -->
            </div>
            <!-- / Content -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../assets/js/ui-modals.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>