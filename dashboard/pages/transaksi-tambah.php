<?php 
if (isset($_REQUEST['id'])) {
   include('components/koneksi.php');
   $id = $_REQUEST['id'];

   $sql = "SELECT * FROM detail_transaksi
           LEFT JOIN transaksi ON detail_transaksi.id_transaksi = transaksi.id
           LEFT JOIN buku ON detail_transaksi.kode_buku = buku.kode
           LEFT JOIN anggota ON detail_transaksi.nik_anggota = anggota.nik
           WHERE detail_transaksi.id_transaksi = '$id'
   ";

   $query = mysqli_query($koneksi, $sql);
   $buku = [];
   if (mysqli_num_rows($query) > 0) {
       while ($row = mysqli_fetch_array($query)) {
           $buku[] = $row; // Menyimpan setiap baris data ke dalam array
       }
   }

   $query = mysqli_query($koneksi, $sql);
   $data = mysqli_fetch_array($query);
}
?>

<div class="container-xxl flex-grow-1 container-p-y">
   <form action="pages/proses-transaksi/proses-tambah.php" method="POST">
      <div class="row">
         <div class="col-lg mb-4 order-0">
            <div class="d-flex m-3">
               <!-- fORM PEMINJAM -->
               <div class="col-md-6 me-2">
                  <div class="card mb-4">
                     <h5 class="card-header">Form Penambahan</h5>
                     <?php
                            if (isset($_SESSION['msg']['sukses'])) {
                                echo '
                                    <div class="alert alert-success" role="alert">
                                        ' . $_SESSION['msg']['sukses'] . '
                                    </div>
                                ';
                            }

                            if (isset($_SESSION['msg']['failed'])) {
                                echo '
                                    <div class="alert alert-danger" role="alert">
                                        ' . $_SESSION['msg']['failed'] . '
                                    </div>
                                ';
                            }
                            ?>
                     <div class="card-body">
                        <div class="mb-3">
                           <label class="form-label">NIK</label>
                           <div class="input-group">
                              <input type="text" name="nik_anggota" class="form-control" placeholder="1472..."
                                 onkeyup="showName(this.value)" value="<?= $data['nik_anggota'] ?>" />
                              <span class=" btn btn-outline-primary">Cari</span>
                           </div>
                           <?php if (isset($_SESSION['msg']['err-nik'])) {
                              echo '<div class="text text-danger">' . $_SESSION['msg']['err-nik'] . '</div>';
                           } ?>
                        </div>
                        <div class="mb-3">
                           <label class="form-label">NAMA</label>
                           <input type="text" id="namaAnggota" name="nama_anggota" class="form-control"
                              value="<?= isset($data['nama']) ? $data['nama'] : ''; ?>" readonly />
                        </div>
                        <div class="mb-3">
                           <label class="form-label">Tanggal Pinjam</label>
                           <input class="form-control form-control-lg" type="date" name="tgl_pinjam"
                              value="<?= $data['tgl_pinjam']; ?>" />
                           <?php if (isset($_SESSION['msg']['err-tgl'])) {
                              echo '<div class="text text-danger">' . $_SESSION['msg']['err-tgl'] . '</div>';
                           } ?>
                        </div>
                        <div class="mb-3" hidden>
                           <label class="form-label">ID</label>
                           <input type="text" name="id" class="form-control"
                              value="<?= isset($data['id']) ? $data['id'] : ''; ?>" readonly />
                        </div>
                        <button type="submit" name="btn-submit" class="btn btn-primary">Submit</button>
                     </div>
                  </div>
               </div>

               <!-- FORM BUKU -->
               <div class="col-md-6 me-3">
                  <div class="card mb-4">
                     <h5 class="card-header">Input Buku</h5>
                     <?php
                     if (isset($_SESSION['msg']['err-buku'])) {
                        echo '<div class="alert alert-danger" role="alert">' . $_SESSION['msg']['err-buku'] . '</div>';
                        } ?>

                     <?php 
                        $jumlahBuku = 5;
                        for ($i = 1; $i <= $jumlahBuku; $i++) {
                           if ($i <= count($buku)) {
                     ?>
                     <div class="card-body">
                        <small class="text-light fw-semibold">Buku <?php echo $i; ?></small>
                        <div class="mb-3">
                           <label class="form-label">Kode</label>
                           <div class="input-group">
                              <input readonly type="text" class="form-control" placeholder="123"
                                 name="buku<?php echo $i; ?>" value="<?= $buku[$i - 1]['kode']; ?>" />
                              <span class="btn btn-outline-primary">Cari</span>
                           </div>
                        </div>
                        <div class="mb-3">
                           <label for="exampleFormControlInput1" class="form-label">Judul</label>
                           <input readonly type="text" id="kolomBuku<?php echo $i; ?>" class="form-control"
                              value="<?= $buku[$i - 1]['judul']; ?>" />
                        </div>
                     </div>
                     <?php } else { ?>
                     <div class=" card-body">
                        <small class="text-light fw-semibold">Buku <?php echo $i; ?></small>
                        <div class="mb-3">
                           <label class="form-label">Kode</label>
                           <div class="input-group">
                              <input type="text" class="form-control" placeholder="123" name="buku<?php echo $i; ?>"
                                 onkeyup="showBook(this.value, <?php echo $i; ?>)" />
                              <span class="btn btn-outline-primary">Cari</span>
                           </div>
                        </div>
                        <div class="mb-3">
                           <label for="exampleFormControlInput1" class="form-label">Judul</label>
                           <input type="text" id="kolomBuku<?php echo $i; ?>" class="form-control" value="" readonly />
                        </div>
                     </div>
                     <hr class="m-0" />
                     <?php } 
                     } ?>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </form>
</div>

<?php
include('proses-transaksi/live-search.php');
unset($_SESSION['msg']);
?>