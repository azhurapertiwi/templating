<?php 
include("components/koneksi.php");
$query = "SELECT *, COUNT(detail_transaksi.id_transaksi) AS pinjam_buku
        FROM transaksi
        LEFT JOIN detail_transaksi ON transaksi.id = detail_transaksi.id_transaksi
        LEFT JOIN anggota ON transaksi.nik_anggota = anggota.nik
        GROUP BY detail_transaksi.id_transaksi
        ORDER BY detail_transaksi.id DESC
    ";
$q = mysqli_query($koneksi, $query);
$no = 1;
?>

<div class="container-xxl flex-grow-1 container-p-y">
   <div class="row">
      <div class="col-lg mb-4 order-0">
         <div class="card">
            <h5 class="card-header">DATA PEMINJAMAN</h5>
            <?php if (isset($_SESSION['msg']['sukses'])) { ?>
            <div class="alert alert-success ms-2 me-2" role="alert">
               <?php echo $_SESSION['msg']['sukses']; ?>
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
                        <td><?php echo ($data['tgl_kembali'] != null) ? '0' : $data['pinjam_buku'] ?>/5
                        </td>
                        <td><?php echo $data['tgl_pinjam'] ?></td>
                        <td>
                           <?php echo ($data['tgl_kembali'] != null) ? $data['tgl_kembali'] : '<b>Belum dikembalikan</b>' ?>
                        </td>
                        <td>
                           <a href="?page=transaksi-detail&detail=<?php echo $data['id_transaksi']; ?>"
                              class="btn btn-sm btn-primary">
                              Detail
                              <i class="ri-book-open-line"></i>
                           </a>
                           <a href="?page=transaksi-tambah&id=<?php echo $data['id_transaksi']; ?>"
                              class="btn btn-sm btn-success <?php echo ($data['tgl_kembali'] != null || $data['pinjam_buku'] == '5') ? 'disabled' : null ?>">
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