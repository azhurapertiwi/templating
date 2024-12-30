<div class="container-xxl flex-grow-1 container-p-y">
    <form action="pages/proses-transaksi/proses-kembali.php" method="POST">
        <div class="row">
            <div class="col-lg mb-4 order-0">
                <div class="d-flex m-3">
                    <!-- FORM PEMINJAM -->
                    <div class="col-md-6 me-2">
                        <div class="card mb-4">
                            <h5 class="card-header">Form Pengembalian</h5>
                            <?php
                            if (isset($_SESSION['msg']['failed'])) {
                                echo '
                                    <div class="alert alert-danger" role="alert">
                                        ' . $_SESSION['msg']['failed'] . '
                                    </div>
                                ';
                            }
                            ?>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">NIK</label>
                                    <div class="input-group">
                                        <input type="text" name="nik_anggota" class="form-control" placeholder="1472..." onkeyup="showName(this.value)" />
                                        <span class=" btn btn-outline-primary">Cari</span>
                                    </div>
                                    <?php if (isset($_SESSION['msg']['nik_anggota'])) {
                                        echo '<div class="alert alert-danger" role="alert">' . $_SESSION['msg']['nik_anggota'] . '</div>';
                                    } ?>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">NAMA</label>
                                    <input type="text" id="namaAnggota" name="nama_anggota" class="form-control" value="<?= isset($data['nama']) ? $data['nama'] : ''; ?>" readonly />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tanggal Kembali</label>
                                    <input class="form-control form-control-lg" type="date" name="tanggal_kembali" />
                                    <?php if (isset($_SESSION['msg']['tanggal_kembali'])) {
                                        echo '<div class="alert alert-danger" role="alert">' . $_SESSION['msg']['tanggal_kembali'] . '</div>';
                                    } ?>
                                </div>
                                <button type="submit" name="btn-submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<?php
include('proses-transaksi/live-search.php');
unset($_SESSION['msg']);
?>