<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg mb-4 order-0">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4">
                            <h5 class="card-header">Anggota Input</h5>
                            <!-- Account -->
                            <hr class="my-0" />
                            <div class="card-body">
                                <?php 
                                    if(isset($_SESSION['msg']['failed'])){
                                        echo '
                                            <div class="alert alert-danger" role="alert">
                                                '.$_SESSION['msg']['failed'].'
                                            </div>
                                        ';
                                    }

                                    if(isset($_SESSION['msg']['anggota'])){
                                        echo '
                                            <div class="alert alert-success" role="alert">
                                                '.$_SESSION['msg']['anggota'].'
                                            </div>
                                        ';
                                    }
                                ?>
                                <form action="pages/proses-anggota/proses-anggota-input.php" method="POST"
                                    enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label for="nik" class="form-label">NIK</label>
                                            <input type="text"
                                                class="form-control <?php echo (isset($_SESSION['msg']['nik'])) ? 'border-danger' : null; ?>"
                                                name="nik" placeholder="NIK"
                                                <?php echo (isset($_SESSION['msg']['code'])) ? null : 'autofocus'; ?> />
                                            <?php if (isset($_SESSION['msg']['nik'])) { ?>
                                            <span class="text-danger"><?php echo $_SESSION['msg']['nik'] ?></span>
                                            <?php } ?>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="name" class="form-label">Nama</label>
                                            <input
                                                class="form-control <?php echo (isset($_SESSION['msg']['nama'])) ? 'border-danger' : null; ?>"
                                                type="text" name="nama" placeholder="nama" />
                                            <?php if (isset($_SESSION['msg']['nama'])) { ?>
                                            <span class="text-danger"><?php echo $_SESSION['msg']['nama'] ?></span>
                                            <?php } ?>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="phoneNumber">No. HP</label>
                                            <div class="input-group input-group-merge">
                                                <span
                                                    class="input-group-text <?php echo (isset($_SESSION['msg']['nomor_hp'])) ? 'border-danger' : null; ?>">
                                                    ID (+62)</span>
                                                <input type="text" id="nomor_hp" name="nomor_hp"
                                                    class="form-control <?php echo (isset($_SESSION['msg']['nomor_hp'])) ? 'border-danger' : null; ?>"
                                                    placeholder="812 3456 7890" />
                                            </div>
                                            <?php if (isset($_SESSION['msg']['nomor_hp'])) { ?>
                                            <span class="text-danger"><?php echo $_SESSION['msg']['nomor_hp'] ?></span>
                                            <?php } ?>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="email" class="form-label">E-mail</label>
                                            <input
                                                class="form-control <?php echo (isset($_SESSION['msg']['email'])) ? 'border-danger' : null; ?>"
                                                type="text" id="email" name="email"
                                                placeholder="your.mail@example.com" />
                                            <?php if (isset($_SESSION['msg']['email'])) { ?>
                                            <span class="text-danger"><?php echo $_SESSION['msg']['email'] ?></span>
                                            <?php } ?>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="alamat" class="form-label">alamat</label>
                                            <input
                                                class="form-control <?php echo (isset($_SESSION['msg']['alamat'])) ? 'border-danger' : null; ?>"
                                                type="text" name="alamat" placeholder="alamat" " />
                                                <?php if (isset($_SESSION['msg']['alamat'])) { ?>
                                            <span class=" text-danger"><?php echo $_SESSION['msg']['alamat'] ?></span>
                                            <?php } ?>
                                        </div>
                                        <div class=" mb-3 col-md-6">
                                            <label for="foto" class="form-label">Foto</label>
                                            <input
                                                class="form-control <?php echo (isset($_SESSION['msg']['foto'])) ? 'border-danger' : null; ?>"
                                                type="file" name="foto" placeholder="" />
                                            <?php if (isset($_SESSION['msg']['foto'])) { ?>
                                            <span class="text-danger"><?php echo $_SESSION['msg']['foto'] ?></span>
                                            <?php } ?>
                                        </div>
                                        <div class="mt-2">
                                            <button name="btn-submit" type="submit" class="btn btn-primary me-2">
                                                Save
                                            </button>
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