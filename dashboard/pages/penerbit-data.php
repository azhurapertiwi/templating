<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg mb-4 order-0">
            <div class="card">
                <h5 class="card-header">DATA PENERBIT</h5>
                <div class="table-responsive text-nowrap">
                    <?php 
                            if(isset($_SESSION['msg']['success'])){
                                echo '
                                    <div class="alert alert-success" role="alert">
                                        '.$_SESSION['msg']['success'].'
                                    </div>
                                ';
                            }
                        ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>KODE</th>
                                <th>NAMA</th>
                                <th>ALAMAT</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <?php 
                                include('components/koneksi.php');
                                $query = "SELECT * FROM penerbit";
                                $q = mysqli_query($koneksi, $query);
                                $no = 1;
                                while ($data = mysqli_fetch_array($q)) {
                            ?>
                            <tr>
                                <td scope="row"><?= $no++ ?></td>
                                <td><?= $data['penerbit_kode'] ?></td>
                                <td><?= $data['penerbit_nama'] ?></td>
                                <td><?= $data['penerbit_alamat'] ?></td>
                                <td>
                                    <a href="pages/proses-penerbit/proses-penerbit-delete.php?kode=<?= $data['penerbit_kode'] ?>"
                                        onclick="return confirm('Anda yakin menghapus data ini?')"><i
                                            class="bx bxs-trash-alt text-danger"></i></a> |
                                    <a href="?page=penerbit-input-update&kode=<?= $data['penerbit_kode'] ?>"><i
                                            class="bx bxs-pencil text-primary"></i></a>
                                </td>
                            </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
unset($_SESSION['msg']);
?>