<?php 
include('components/koneksi.php');
$kode = $_REQUEST['kode'];
$sql = "SELECT * FROM buku WHERE kode='$kode'";
$query = mysqli_query($koneksi, $sql);
$data = mysqli_fetch_array($query);

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
                                    if(isset($_SESSION['msg']['error'])){
                                        echo '
                                            <div class="alert alert-danger" role="alert">
                                                '.$_SESSION['msg']['error'].'
                                            </div>
                                        ';
                                    }

                                    if(isset($_SESSION['msg']['success'])){
                                        echo '
                                            <div class="alert alert-success" role="alert">
                                                '.$_SESSION['msg']['success'].'
                                            </div>
                                        ';
                                    }
                                ?>
                                <form action="pages/proses-buku/proses-buku-update.php" method="POST">
                                    <div class="row">
                                        <div class="mb-3 col-4">
                                            <label for="zipCode" class="form-label">Kode</label>
                                            <input
                                                class="form-control <?php echo (isset($_SESSION['msg']['kode'])) ? 'border-danger' : null; ?>"
                                                value="<?php echo $data['kode']; ?>" type="text" name="kode"
                                                placeholder="B-book" readonly />
                                            <?php if (isset($_SESSION['msg']['kode'])) { ?>
                                            <span class="text-danger"><?php echo $_SESSION['msg']['kode'] ?></span>
                                            <?php } ?>
                                        </div>
                                        <div class="mb-3 col-4">
                                            <label for="firstName" class="form-label">Judul</label>
                                            <input
                                                class="form-control <?php echo (isset($_SESSION['msg']['judul'])) ? 'border-danger' : null; ?>"
                                                value="<?php echo $data['judul']; ?>" type="text" name="judul"
                                                placeholder="Book judul"
                                                <?php echo (isset($_SESSION['msg']['judul'])) ? null : 'autofocus'; ?> />
                                            <?php if (isset($_SESSION['msg']['judul'])) { ?>
                                            <span class="text-danger"><?php echo $_SESSION['msg']['judul'] ?></span>
                                            <?php } ?>
                                        </div>
                                        <div class="mb-3 col-4">
                                            <label class="form-label" for="country">Kategori</label>
                                            <select
                                                class="select2 form-select <?php echo (isset($_SESSION['msg']['kategori'])) ? 'border-danger' : null; ?>"
                                                value="<?php echo $data['kategori_kode']; ?>" name="kategori">
                                                <option value="">-- Select kategori --</option>
                                                <?php while($var = mysqli_fetch_array($selectkategori)) { ?>
                                                <option value="<?php echo $var['kategori_kode'];?>"
                                                    <?php echo ($var['kategori_kode'] == $data['kategori_kode']) ? 'selected' : ''; ?>>
                                                    <?php echo $var['kategori_nama']; ?></option>
                                                <?php } ?>
                                            </select>
                                            <?php if (isset($_SESSION['msg']['kategori'])) { ?>
                                            <span class="text-danger"><?php echo $_SESSION['msg']['kategori'] ?></span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-4">
                                            <label for="zipCode" class="form-label">ISBN</label>
                                            <input
                                                class="form-control <?php echo (isset($_SESSION['msg']['isbn'])) ? 'border-danger' : null; ?>"
                                                value="<?php echo $data['isbn']; ?>" type="text" name="isbn"
                                                placeholder="123-456-7890-12-3" />
                                            <?php if (isset($_SESSION['msg']['isbn'])) { ?>
                                            <span class="text-danger"><?php echo $_SESSION['msg']['isbn'] ?></span>
                                            <?php } ?>
                                        </div>
                                        <div class="mb-3 col-4">
                                            <label for="firstName" class="form-label">Penulis</label>
                                            <input
                                                class="form-control <?php echo (isset($_SESSION['msg']['penulis'])) ? 'border-danger' : null; ?>"
                                                value="<?php echo $data['penulis']; ?>" type="text" name="penulis"
                                                placeholder="J.K. Rowling; J.R.R. Tolkien; ..." />
                                            <?php if (isset($_SESSION['msg']['penulis'])) { ?>
                                            <span class="text-danger"><?php echo $_SESSION['msg']['penulis'] ?></span>
                                            <?php } ?>
                                        </div>
                                        <div class="mb-3 col-4">
                                            <label class="form-label" for="country">Penerbit</label>
                                            <select
                                                class="select2 form-select <?php echo (isset($_SESSION['msg']['penerbit'])) ? 'border-danger' : null; ?>"
                                                value="<?php echo $data['penerbit_kode']; ?>" name="penerbit">
                                                <option value="">-- Select penerbit --</option>
                                                <?php while($var = mysqli_fetch_array($selectpenerbit)) { ?>
                                                <option value="<?php echo $var['penerbit_kode'];?>"
                                                    <?php echo ($var['penerbit_kode'] == $data['penerbit_kode']) ? 'selected' : ''; ?>>
                                                    <?php echo $var['penerbit_nama']; ?>
                                                </option>
                                                <?php } ?>
                                            </select>
                                            <?php if (isset($_SESSION['msg']['penerbit'])) { ?>
                                            <span class="text-danger"><?php echo $_SESSION['msg']['penerbit'] ?></span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-4">
                                            <label for="zipCode" class="form-label">Tahun</label>
                                            <input
                                                class="form-control <?php echo (isset($_SESSION['msg']['tahun'])) ? 'border-danger' : null; ?>"
                                                value="<?php echo $data['tahun']; ?>" type="tahun" name="tahun" />
                                            <?php if (isset($_SESSION['msg']['tahun'])) { ?>
                                            <span class="text-danger"><?php echo $_SESSION['msg']['tahun'] ?></span>
                                            <?php } ?>
                                        </div>
                                        <div class="mb-3 col-4">
                                            <label for="firstName" class="form-label">Cover</label>
                                            <input type="file"
                                                class="form-control <?php echo (isset($_SESSION['msg']['cover'])) ? 'border-danger' : null; ?>"
                                                value="<?php echo (isset($_SESSION['value']['cover']) && $_SESSION['value']['cover'] != '') ? $_SESSION['value']['cover'] : $data['cover']; ?>"
                                                name="cover" />
                                            <?php echo $data['cover']; ?>
                                            <br />
                                            <?php if (isset($_SESSION['msg']['cover'])) { ?>
                                            <span class="text-danger"><?php echo $_SESSION['msg']['cover']; ?></span>
                                            <?php } ?>
                                        </div>
                                        <div class="mb-3 col-4">
                                            <label class="form-label" for="country">Bahasa</label>
                                            <select
                                                class="select2 form-select <?php echo (isset($_SESSION['msg']['bahasa'])) ? 'border-danger' : null; ?>"
                                                value="<?php echo $data['bahasa']; ?>" name="bahasa">
                                                <option value="">-- Select bahasa --</option>
                                                <option value="Indonesia"
                                                    <?php echo (isset($data['bahasa']) && $data['bahasa'] == 'Indonesia') ? 'selected' : ''; ?>>
                                                    Indonesia
                                                </option>
                                                <option value="English"
                                                    <?php echo (isset($data['bahasa']) && $data['bahasa'] == 'English') ? 'selected' : ''; ?>>
                                                    English
                                                </option>
                                            </select>
                                            <?php if (isset($_SESSION['msg']['bahasa'])) { ?>
                                            <span class="text-danger"><?php echo $_SESSION['msg']['bahasa'] ?></span>
                                            <?php } ?>
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Sinopsis</span>
                                            <div class="input-group">
                                                <textarea
                                                    class="form-control ps-3 <?php echo (isset($_SESSION['msg']['sinopsis'])) ? 'border-danger' : null; ?>"
                                                    value="" name="sinopsis" placeholder="typing..."
                                                    rows="2"><?php echo $data['sinopsis']; ?></textarea>
                                            </div>
                                            <?php if (isset($_SESSION['msg']['sinopsis'])) { ?>
                                            <span class="text-danger"><?php echo $_SESSION['msg']['sinopsis'] ?></span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <button type="submit" name="btn-submit" class="btn btn-primary me-2">Simpan
                                            perubahan</button>
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
unset($_SESSION['value']);
?>