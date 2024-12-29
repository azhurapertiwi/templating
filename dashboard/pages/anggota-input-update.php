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
                                <form action="pages/proses-anggota/proses-anggota-input.php" method="POST"
                                    onsubmit="return false">
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label for="firstName" class="form-label">NIK</label>
                                            <input readonly value="<?= $data['nik'] ?>" name="nik" type="text"
                                                class="form-control bg-light" />
                                            <?php 
                                                if(isset($_SESSION['msg']['err_nik'])){
                                                    echo '<span class="text-danger">'.$_SESSION['msg']['err_nik'].'</span>';
                                                }
                                            ?>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="lastName" class="form-label">Nama</label>
                                            <input name="nama" class="form-control" type="text"
                                                placeholder="John Doe" />
                                            <?php 
                                                if(isset($_SESSION['msg']['err_nama'])){
                                                    echo '<span class="text-danger">'.$_SESSION['msg']['err_nama'].'</span>';
                                                }
                                            ?>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="phoneNumber">No. HP</label>
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text">ID (+62)</span>
                                                <input name="no_hp" type="text" class="form-control"
                                                    placeholder="812 3456 7890" />
                                                <?php 
                                                    if(isset($_SESSION['msg']['err_no_hp'])){
                                                        echo '<span class="text-danger">'.$_SESSION['msg']['err_no_hp'].'</span>';
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="email" class="form-label">E-mail</label>
                                            <input name="email" class="form-control" type="text"
                                                placeholder="john.doe@example.com" />
                                            <?php 
                                                if(isset($_SESSION['msg']['err_email'])){
                                                    echo '<span class="text-danger">'.$_SESSION['msg']['err_email'].'</span>';
                                                }
                                            ?>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="address" class="form-label">alamat</label>
                                            <input name="alamat" type="text" class="form-control"
                                                placeholder="Jl. Soekarno-Hatta" />
                                            <?php 
                                                if(isset($_SESSION['msg']['err_alamat'])){
                                                    echo '<span class="text-danger">'.$_SESSION['msg']['err_alamat'].'</span>';
                                                }
                                            ?>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="organization" class="form-label">Foto</label>
                                            <input name="foto" type="file" class="form-control" />
                                            <?php 
                                                if(isset($_SESSION['msg']['err_foto'])){
                                                    echo '<span class="text-danger">'.$_SESSION['msg']['err_foto'].'</span>';
                                                }
                                            ?>
                                        </div>
                                        <div class="mt-2">
                                            <button name="btn-submit" type="submit" class="btn btn-primary me-2">
                                                Perubahan
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