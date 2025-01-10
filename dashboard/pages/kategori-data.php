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
                        <th>NAMA</th>
                        <th>AKSI</th>
                     </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
                     <?php 
                                include('components/koneksi.php');
                                $query = "SELECT * FROM kategori";
                                $q = mysqli_query($koneksi, $query);
                                $no = 1;
                                while ($data = mysqli_fetch_array($q)) {
                            ?>
                     <tr>
                        <th scope="row"><?= $no++ ?></th>
                        <td><?= $data['kategori_kode'] ?></td>
                        <td><?= $data['kategori_nama'] ?></td>
                        <td>
                           <a href="pages/proses-kategori/proses-kategori-delete.php?kode=<?= $data['kategori_kode'] ?>"
                              onclick="return confirm('Anda yakin menghapus data ini?')"><i
                                 class="bx bxs-trash-alt text-danger"></i></a> |
                           <a href="?page=kategori-input-update&kode=<?= $data['kategori_kode'] ?>"><i
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