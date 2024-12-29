<?php 
include('components/koneksi.php');
$sql = "SELECT * FROM buku
         LEFT JOIN kategori ON buku.kategori_kode = kategori.kategori_kode 
         LEFT JOIN penerbit ON buku.penerbit_kode = penerbit.penerbit_kode";

$query = mysqli_query($koneksi, $sql);

// for update
if (isset($_REQUEST['kode'])) {
   $kode = $_REQUEST['kode'];
   $sql = "SELECT * FROM buku WHERE kode='$kode'";
   $query = mysqli_query($koneksi, $sql);
   $data = mysqli_fetch_array($query);
}
$no = 1;
?>

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg mb-4 order-0">
            <div class="card">
                <h5 class="card-header">DATA BUKU</h5>
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
                                <th>JUDUL</th>
                                <th>KATEGORI</th>
                                <th>ISBN</th>
                                <th>PENULIS</th>
                                <th>PENERBIT</th>
                                <th>TAHUN</th>
                                <th>COVER</th>
                                <th>BAHASA</th>
                                <th>SINOPSIS</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <?php 
                                include('components/koneksi.php');
                                $query = "SELECT * FROM buku";
                                $q = mysqli_query($koneksi, $query);
                                $no = 1;
                                while ($data = mysqli_fetch_array($q)) {
                            ?>
                            <tr>
                                <td scope="row"><?= $no++ ?></td>
                                <td><?= $data['kode'] ?></td>
                                <td><?= $data['judul'] ?></td>
                                <td><?= $data['kategori_kode'] ?></td>
                                <td><?= $data['isbn'] ?></td>
                                <td><?= $data['penulis'] ?></td>
                                <td><?= $data['penerbit_kode'] ?></td>
                                <td><?= $data['tahun'] ?></td>
                                <td>
                                    <img class="w-100" src="pages/proses-buku/image/<?= $data['cover'] ?>" alt="">
                                </td>
                                <td><?= $data['bahasa'] ?></td>
                                <td><?= $data['sinopsis'] ?></td>
                                </td>
                                <td>
                                    <a href="pages/proses-buku/proses-buku-delete.php?kode=<?= $data['kode'] ?>"
                                        onclick="return confirm('Anda yakin menghapus data ini?')"><i
                                            class="bx bxs-trash-alt text-danger"></i></a> |
                                    <a href="?page=buku-input-update&kode=<?= $data['kode'] ?>"><i
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