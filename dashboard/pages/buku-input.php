<?php
include('components/koneksi.php');

$kategori = "SELECT * FROM kategori";
$selectkategori = mysqli_query($koneksi, $kategori);

$penerbit = "SELECT * FROM penerbit";
$selectpenerbit = mysqli_query($koneksi, $penerbit);
?>

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg mb-4 order-0">
            <div class="container-xxl flex-grow-1 container-p-y">
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Input Buku</h4>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4">
                            <h5 class="card-header">Input Buku</h5>
                            <!-- Account -->
                            <hr class="my-0" />
                            <div class="card-body">
                                <?php
                                if (isset($_SESSION['msg']['error'])) {
                                    echo '
                                            <div class="alert alert-danger" role="alert">
                                                ' . $_SESSION['msg']['error'] . '
                                            </div>
                                        ';
                                }

                                if (isset($_SESSION['msg']['success'])) {
                                    echo '
                                            <div class="alert alert-success" role="alert">
                                                ' . $_SESSION['msg']['success'] . '
                                            </div>
                                        ';
                                }
                                ?>
                                <form action="pages/proses-buku/proses-buku-input.php" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="mb-3 col-4">
                                            <label for="zipCode" class="form-label">Kode</label>
                                            <input name="kode" type="text" class="form-control" id="zipCode" placeholder="231465"
                                                <?php echo (isset($_SESSION['msg']['err_kode'])) ? null : 'autofocus'; ?> />
                                            <?php
                                            if (isset($_SESSION['msg']['err_kode'])) {
                                                echo '<span class="text-danger">' . $_SESSION['msg']['err_kode'] . '</span>';
                                            }
                                            ?>
                                        </div>
                                        <div class="mb-3 col-4">
                                            <label for="firstName" class="form-label">Judul</label>
                                            <input name="judul" class="form-control" type="text" id="firstName" />
                                            <?php
                                            if (isset($_SESSION['msg']['err_judul'])) {
                                                echo '<span class="text-danger">' . $_SESSION['msg']['err_judul'] . '</span>';
                                            }
                                            ?>
                                        </div>
                                        <div class="mb-3 col-4">
                                            <label class="form-label" for="country">Kategori</label>
                                            <select
                                                class="select2 form-select <?php echo (isset($_SESSION['msg']['kategori'])) ? 'border-danger' : null; ?>"
                                                value="<?php echo (isset($_SESSION['value']['kategori'])) ? $_SESSION['value']['kategori'] : null; ?>"
                                                name="kategori">
                                                <option value="">-- Select kategori --</option>
                                                <?php while ($var = mysqli_fetch_array($selectkategori)) { ?>
                                                    <option value="<?php echo $var['kategori_kode']; ?>"
                                                        <?php echo (isset($_SESSION['value']['kategori']) && $_SESSION['value']['kategori'] == $var['kategori_kode']) ? 'selected' : ''; ?>>
                                                        <?php echo $var['kategori_nama']; ?></option>
                                                <?php } ?>
                                            </select>
                                            <?php
                                            if (isset($_SESSION['msg']['err_kategori'])) {
                                                echo '<span class="text-danger">' . $_SESSION['msg']['err_kategori'] . '</span>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-4">
                                            <label for="zipCode" class="form-label">ISBN</label>
                                            <input type="text" class="form-control" name="isbn" placeholder="231465" />
                                            <?php
                                            if (isset($_SESSION['msg']['err_isbn'])) {
                                                echo '<span class="text-danger">' . $_SESSION['msg']['err_isbn'] . '</span>';
                                            }
                                            ?>
                                        </div>
                                        <div class="mb-3 col-4">
                                            <label for="firstName" class="form-label">Penulis</label>
                                            <input class="form-control" type="text" name="penulis">
                                            <?php
                                            if (isset($_SESSION['msg']['err_penulis'])) {
                                                echo '<span class="text-danger">' . $_SESSION['msg']['err_penulis'] . '</span>';
                                            }
                                            ?>
                                        </div>
                                        <div class="mb-3 col-4">
                                            <label class="form-label" for="country">Penerbit</label>
                                            <select
                                                class="select2 form-select <?php echo (isset($_SESSION['msg']['penerbit'])) ? 'border-danger' : null; ?>"
                                                value="<?php echo (isset($_SESSION['value']['penerbit'])) ? $_SESSION['value']['penerbit'] : null; ?>"
                                                name="penerbit">
                                                <option value="">-- Select penerbit --</option>
                                                <?php while ($var = mysqli_fetch_array($selectpenerbit)) { ?>
                                                    <option value="<?php echo $var['penerbit_kode']; ?>"
                                                        <?php echo (isset($_SESSION['value']['penerbit']) && $_SESSION['value']['penerbit'] == $var['penerbit_kode']) ? 'selected' : ''; ?>>
                                                        <?php echo $var['penerbit_nama']; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                            <?php
                                            if (isset($_SESSION['msg']['err_penerbit'])) {
                                                echo '<span class="text-danger">' . $_SESSION['msg']['err_penerbit'] . '</span>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-4">
                                            <label for="zipCode" class="form-label">Tahun</label>
                                            <input type="date" class="form-control" name="tahun" placeholder="2024"
                                                maxlength="4" />
                                            <?php
                                            if (isset($_SESSION['msg']['err_tahun'])) {
                                                echo '<span class="text-danger">' . $_SESSION['msg']['err_tahun'] . '</span>';
                                            }
                                            ?>
                                        </div>
                                        <div class="mb-3 col-4">
                                            <label for="firstName" class="form-label">Cover</label>
                                            <div class="input-group">
                                                <input type="file" class="form-control" name="cover" />
                                            </div>
                                            <?php
                                            if (isset($_SESSION['msg']['err_cover'])) {
                                                echo '<span class="text-danger">' . $_SESSION['msg']['err_cover'] . '</span>';
                                            }
                                            ?>
                                        </div>
                                        <div class="mb-3 col-4">
                                            <label class="form-label" for="country">Bahasa</label>
                                            <select
                                                class="select2 form-select <?php echo (isset($_SESSION['msg']['bahasa'])) ? 'border-danger' : null; ?>"
                                                name="bahasa">
                                                <option value="">-- Select bahasa --</option>
                                                <option value="Indonesia"
                                                    <?php echo (isset($_SESSION['value']['bahasa']) && $_SESSION['value']['bahasa'] == 'Indonesia') ? 'selected' : ''; ?>>
                                                    Indonesia
                                                </option>
                                                <option value="English"
                                                    <?php echo (isset($_SESSION['value']['bahasa']) && $_SESSION['value']['bahasa'] == 'English') ? 'selected' : ''; ?>>
                                                    English
                                                </option>
                                            </select>
                                            <?php
                                            if (isset($_SESSION['msg']['err_bahasa'])) {
                                                echo '<span class="text-danger">' . $_SESSION['msg']['err_bahasa'] . '</span>';
                                            }
                                            ?>
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-text">Sinopsis</span>
                                            <textarea class="form-control" name="sinopsis" aria-label="With textarea" placeholder="Comment"></textarea>
                                        </div>
                                        <?php
                                        if (isset($_SESSION['msg']['err_sinopsis'])) {
                                            echo '<span class="text-danger">' . $_SESSION['msg']['err_sinopsis'] . '</span>';
                                        }
                                        ?>
                                    </div>
                                    <div class="mt-5">
                                        <button type="submit" name="btn-submit" class="btn btn-primary me-2">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
unset($_SESSION['msg']);
?>