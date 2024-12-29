<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg mb-4 order-0">
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Input Kategori</h5>
                    </div>
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
                        <form action="pages/proses-kategori/proses-kategori-input.php" method="POST">
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-kode">Kode</label>
                                <div class="col-sm-10">
                                    <input name="kode" type="text" class="form-control" id="basic-default-kode"
                                        class="form-control kode-mask" placeholder="Masukkan Kode" />
                                    <?php 
                                        if(isset($_SESSION['msg']['err_kode'])){
                                            echo '<span class="text-danger">'.$_SESSION['msg']['err_kode'].'</span>';
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Nama</label>
                                <div class="col-sm-10">
                                    <input name="nama" type="text" class="form-control" id="basic-default-name"
                                        placeholder="Masukkan Nama" />
                                    <?php 
                                        if(isset($_SESSION['msg']['err_nama'])){
                                            echo '<span class="text-danger">'.$_SESSION['msg']['err_nama'].'</span>';
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" name="btn-submit" class="btn btn-primary">Tambahkan
                                        Data</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
unset($_SESSION['msg']);
?>