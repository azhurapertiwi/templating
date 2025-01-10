<div class="container-xxl flex-grow-1 container-p-y">
   <a href="?page=transaksi-data" class="btn btn-primary mb-3">Kembali</a>

   <!-- ANGGOTA -->
   <div class="row">
      <div class="col-lg mb-4 order-0">
         <div class="card">
            <h5 class="card-header">DATA ANGGOTA</h5>
            <div class="table-responsive text-nowrap">
               <table class="table table-striped">
                  <thead>
                     <tr>
                        <th>NIK</th>
                        <th>NAMA</th>
                        <th>EMAIL</th>
                        <th>NO HP</th>
                        <th>ALAMAT</th>
                        <th>FOTO</th>
                     </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
                     <?php
                        if (isset($_REQUEST['detail'])) {
                           $id = $_REQUEST['detail'];
                           include('components/koneksi.php');
                           $query = "SELECT * FROM detail_transaksi
                                    LEFT JOIN anggota ON detail_transaksi.nik_anggota = anggota.nik
                                    WHERE detail_transaksi.id_transaksi = '$id' ";
                           $q = mysqli_query($koneksi, $query);
                           $data = mysqli_fetch_array($q);
                        }
                     ?>
                     <tr>
                        <td><?= $data['nik'] ?></td>
                        <td><?= $data['nama'] ?></td>
                        <td><?= $data['email'] ?></td>
                        <td><?= $data['no_hp'] ?></td>
                        <td><?= $data['alamat'] ?></td>
                        <td>
                           <img style="width: 100px;" src="pages/proses-anggota/image/<?= $data['foto'] ?>" alt="">
                        </td>
                     </tr>
                     <?php
                            ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
   <!-- BUKU -->
   <div class="row">
      <div class="col-lg mb-4 order-0">
         <div class="card">
            <h5 class="card-header">DATA BUKU</h5>
            <div class="table-responsive text-nowrap">
               <table class="table table-striped">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th>KODE</th>
                        <th>JUDUL</th>
                        <th>COVER</th>
                        <th>PENGEMBALIAN</th>
                     </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
                     <?php
                     if (isset($_REQUEST['detail'])) {
                        $id = $_REQUEST['detail'];
                        include('components/koneksi.php');
                        $sql = "SELECT * FROM detail_transaksi
                                 LEFT JOIN transaksi ON detail_transaksi.id_transaksi = transaksi.id
                                 LEFT JOIN buku ON detail_transaksi.kode_buku = buku.kode
                                 WHERE detail_transaksi.id_transaksi = '$id'   
                              ";
                        
                        $query = mysqli_query($koneksi, $sql);
                     }
                     $no = 1;
                     while ($data = mysqli_fetch_array($query)) {
                     ?>
                     <tr>
                        <td scope="row"><?= $no++ ?></td>
                        <td><?= $data['kode'] ?></td>
                        <td><?= $data['judul'] ?></td>
                        <td>
                           <img width="100" src="pages/proses-buku/image/<?= $data['cover'] ?>" alt="">
                        </td>
                        <td><?= ($data['tgl_kembali'] != null) ? $data['tgl_kembali'] : '<b>Belum dikembalikan</b>' ?>
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