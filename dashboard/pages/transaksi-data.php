<?php 
include("components/koneksi.php");
$query = "SELECT 
            transaksi.id 
            transaksi.nik_anggota, 
            transaksi.tanggal_pinjam, 
            transaksi.tanggal_kembali, 
            detail_transaksi.id_transaksi, 
            anggota.nik, anggota.nama, 
            COUNT(detail_transaksi.id_transaksi) AS pinjam_buku
        FROM transaksi
        LEFT JOIN detail_transaksi ON transaksi.id = detail_transaksi.id_transaksi
        LEFT JOIN anggota ON transaksi.nik_anggota = anggota.nik
    ";
$q = mysqli_query($koneksi, $query);
$no = 1;
?>

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg mb-4 order-0">
            <div class="card">
                <h5 class="card-header">DATA PEMINJAMAN</h5>
                <?php if (isset($_SESSION['msg']['kembali'])) { ?>
                <div class="alert alert-success ms-2 me-2" role="alert">
                    <?php echo $_SESSION['msg']['kembali']; ?>
                </div>
                <?php } ?>

                <?php if (isset($_SESSION['msg']['hapus'])) { ?>
                <div class="alert alert-success ms-2 me-2" role="alert">
                    <?php echo $_SESSION['msg']['hapus']; ?>
                </div>
                <?php } ?>
                <div class="table-responsive text-nowrap">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Peminjaman Buku</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Kembali</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <?php while ($data = mysqli_fetch_array($q)) { ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $data['nik']; ?></td>
                                <td><?php echo $data['nama']; ?></td>
                                <td><?php echo ($data['tanggal_kembali'] != null) ? '0' : $data['pinjam_buku'] ?>/5
                                </td>
                                <td><?php echo $data['tanggal_pinjam'] ?></td>
                                <td><?php echo ($data['tanggal_kembali'] != null) ? $data['tanggal_kembali'] : '<b>Not kembali yet</b>' ?>
                                </td>
                                <td>
                                    <a href="?page=transaction/detail-borrower&id_tr=<?php echo $data['id_transaksi']; ?>"
                                        class="btn btn-sm btn-warning">
                                        Detail
                                        <i class="ri-book-open-line"></i>
                                    </a>
                                    <a href="?page=transaction/borrow-update&id=<?php echo $data['id_transaksi']; ?>"
                                        class="btn btn-sm btn-info <?php echo ($data['tanggal_kembali'] != null || $data['pinjam_buku'] == '5') ? 'disabled' : null ?>">
                                        Add books
                                        <i class="ri-add-line"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php unset($_SESSION['msg']); ?>