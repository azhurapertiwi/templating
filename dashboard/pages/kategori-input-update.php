<?php 
$kode = $_REQUEST['kode'];
include('components/koneksi.php');
$query = "SELECT * FROM kategori WHERE kategori_kode='$kode'";
$q = mysqli_query($koneksi, $query);
$data = mysqli_fetch_array($q);

?>
<div class="row m-5">
   <div class="col-12">
      <div class="row">
         <div class="col">
            <div class="card">
               <div class="card-body">
                  <h4 class="mb-0">Form Update Kategori</h4>

                  <?php 
                        if(isset($_SESSION['msg']['error'])){
                            echo '
                                <div class="alert alert-danger" role="alert">
                                    '.$_SESSION['msg']['error'].'
                                </div>
                            ';
                        }
                    ?>

                  <form action="pages/proses-kategori/proses-kategori-update.php" method="post">
                     <div class="col-6">
                        <div class="form-group mt-3">
                           <label for="">Kode Kategori</label>
                           <input readonly value="<?= $data['kategori_kode'] ?>" name="kode" type="text"
                              class="form-control bg-light">
                        </div>
                        <div class="form-group mt-3">
                           <label for="">Nama Kategori</label>
                           <input value="<?= $data['kategori_nama'] ?>" name="nama" type="text" class="form-control">
                        </div>
                        <?php 
                            if(isset($_SESSION['msg']['err-nama'])){
                                echo '<span class="text-danger">'.$_SESSION['msg']['err-nama'].'</span>';
                            }
                        ?>

                        <div class="form-group mt-3">
                           <button type="submit" name="btn-submit" class="btn btn-primary">
                              Simpan Perubahan
                           </button>
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