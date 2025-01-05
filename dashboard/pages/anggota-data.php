<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg mb-4 order-0">
            <div class="card">
                <h5 class="card-header">DATA ANGGOTA</h5>
                <div class="table-responsive text-nowrap">
                    <?php
                    if (isset($_SESSION['msg']['success'])) {
                        echo '
                            <div class="alert alert-success" role="alert">
                                ' . $_SESSION['msg']['success'] . '
                            </div>
                        ';
                    }
                    ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>NIK</th>
                                <th>NAMA</th>
                                <th>EMAIL</th>
                                <th>NO HP</th>
                                <th>ALAMAT</th>
                                <th>FOTO</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <?php
                            include('components/koneksi.php');
                            $query = "SELECT * FROM anggota";
                            $q = mysqli_query($koneksi, $query);
                            $no = 1;
                            while ($data = mysqli_fetch_array($q)) {
                            ?>
                            <tr>
                                <td scope="row"><?= $no++ ?></td>
                                <td><?= $data['nik'] ?></td>
                                <td><?= $data['nama'] ?></td>
                                <td><?= $data['email'] ?></td>
                                <td><?= $data['no_hp'] ?></td>
                                <td><?= $data['alamat'] ?></td>
                                <td>
                                    <img style="width: 100px;" src="pages/proses-anggota/image/<?= $data['foto'] ?>"
                                        alt="">
                                </td>
                                <td>
                                    <a href="pages/proses-anggota/proses-anggota-delete.php?nik=<?= $data['nik'] ?>"
                                        onclick="return confirm('Anda yakin menghapus data ini?')"><i
                                            class="bx bxs-trash-alt text-danger"></i></a> |
                                    <a href="?page=anggota-input-update&nik=<?= $data['nik'] ?>"><i
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