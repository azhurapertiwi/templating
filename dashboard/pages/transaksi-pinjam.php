<div class="container-xxl flex-grow-1 container-p-y">
    <form action="pages/proses-transaksi/proses-pinjam.php" method="POST">
        <div class="row">
            <div class="col-lg mb-4 order-0">
                <div class="d-flex m-3">
                    <!-- fORM PEMINJAM -->
                    <div class="col-md-6 me-2">
                        <div class="card mb-4">
                            <h5 class="card-header">Form Peminjaman</h5>
                            <?php
                            if (isset($_SESSION['msg']['sukses'])) {
                                echo '
                                    <div class="alert alert-success" role="alert">
                                        ' . $_SESSION['msg']['sukses'] . '
                                    </div>
                                ';
                            }

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
                                    <label class="form-label">Tanggal Pinjam</label>
                                    <input class="form-control form-control-lg" type="date" name="tanggal_pinjam" />
                                    <?php if (isset($_SESSION['msg']['tanggal_pinjam'])) {
                                        echo '<div class="alert alert-danger" role="alert">' . $_SESSION['msg']['tanggal_pinjam'] . '</div>';
                                    } ?>
                                </div>
                                <button type="submit" name="btn-submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>

                    <!-- FORM BUKU -->
                    <div class="col-md-6 me-3">
                        <div class="card mb-4">
                            <h5 class="card-header">Input Buku</h5>
                            <?php if (isset($_SESSION['msg']['buku'])) {
                                echo '<div class="alert alert-danger" role="alert">' . $_SESSION['msg']['buku'] . '</div>';
                            } ?>
                            <div class="card-body">
                                <small class="text-light fw-semibold">Buku 1</small>
                                <div class="mb-3">
                                    <label class="form-label">Kode</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="123" name="buku1" onkeyup="showBook(this.value, 1)" />
                                        <span class="btn btn-outline-primary">Cari</span>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Judul</label>
                                    <input type="text" id="kolomBuku1" class="form-control" value="" readonly />
                                </div>
                            </div>
                            <hr class="m-0" />
                            <div class="card-body">
                                <small class="text-light fw-semibold">Buku 2</small>
                                <div class="mb-3">
                                    <label class="form-label">Kode</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="123" name="buku2" onkeyup="showBook(this.value, 2)" />
                                        <span class="btn btn-outline-primary">Cari</span>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Judul</label>
                                    <input type="text" id="kolomBuku2" class="form-control" value="" readonly />
                                </div>
                            </div>
                            <hr class="m-0" />
                            <div class="card-body">
                                <small class="text-light fw-semibold">Buku 3</small>
                                <div class="mb-3">
                                    <label class="form-label">Kode</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="123" name="buku3" onkeyup="showBook(this.value, 3)" />
                                        <span class="btn btn-outline-primary">Cari</span>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Judul</label>
                                    <input type="text" id="kolomBuku3" class="form-control" value="" readonly />
                                </div>
                            </div>
                            <hr class="m-0" />
                            <div class="card-body">
                                <small class="text-light fw-semibold">Buku 4</small>
                                <div class="mb-3">
                                    <label class="form-label">Kode</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="123" name="buku4" onkeyup="showBook(this.value, 4)" />
                                        <span class="btn btn-outline-primary">Cari</span>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Judul</label>
                                    <input type="text" id="kolomBuku4" class="form-control" value="" readonly />
                                </div>
                            </div>
                            <hr class="m-0" />
                            <div class="card-body">
                                <small class="text-light fw-semibold">Buku 5</small>
                                <div class="mb-3">
                                    <label class="form-label">Kode</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="123" name="buku5" onkeyup="showBook(this.value, 5)" />
                                        <span class="btn btn-outline-primary">Cari</span>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Judul</label>
                                    <input type="text" id="kolomBuku5" class="form-control" value="" readonly />
                                </div>
                            </div>
                            <hr class="m-0" />
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