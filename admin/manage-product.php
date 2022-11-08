<?php include('partials/menu.php'); ?>

  <!-- Awal Konten -->
    <div class="konten">
      <div class="container mt-3 p-5">
        <h1 class="h2 mb-3">Pengaturan Produk</h1>
        <?php 
          if(isset($_SESSION['add'])){
            echo $_SESSION['add'];
            unset($_SESSION['add']);
          }

          if(isset($_SESSION['remove-image'])){
            echo $_SESSION['remove-image'];
            unset($_SESSION['remove-image']);
          }

          if(isset($_SESSION['delete'])){
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
          }

          if(isset($_SESSION['unauthorized'])){
            echo $_SESSION['unauthorized'];
            unset($_SESSION['unauthorized']);
          }

          if(isset($_SESSION['no-product-found'])){
            echo $_SESSION['no-product-found'];
            unset($_SESSION['no-product-found']);
          }

          if(isset($_SESSION['update'])){
            echo $_SESSION['update'];
            unset($_SESSION['update']);
          }

          if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
          }

          if(isset($_SESSION['remove-failed'])){
            echo $_SESSION['remove-failed'];
            unset($_SESSION['remove-failed']);
          }
        ?>
        <a class="btn btn-primary btn-md mb-3" href="<?php echo SITEURL; ?>admin/add-product.php" role="button">Tambah Produk</a>
        <div class="table-responsive mb-4">
          <table class="table table-bordered table-hover">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">Id</th>
                  <th scope="col">Nama Produk</th>
                  <th scope="col">Harga</th>
                  <th scope="col">Gambar</th>
                  <th scope="col">Deskripsi</th>
                  <th scope="col">Featured</th>
                  <th scope="col">Active</th>
                  <th scope="col">Satuan</th>
                  <th scope="col">Stok</th>
                  <th scope="col">Aksi</th>
                </tr>

                <?php 
                  $sql = "SELECT * FROM tbl_produk";

                  $res = mysqli_query($conn, $sql);

                  $count = mysqli_num_rows($res);
                  $sn = 1;
                  if($count>0){
                    while($row=mysqli_fetch_assoc($res)){
                      $id = $row['id'];
                      $namaProduk = $row['namaProduk'];
                      $harga = $row['harga'];
                      $namaGambar = $row['namaGambar'];
                      $deskripsi = $row['deskripsi'];
                      $featured = $row['featured'];
                      $active = $row['active'];
                      $satuan = $row['satuan'];
                      $stok = $row['stok'];

                      ?>
                      <tbody>
                        <tr>
                          <th scope="row"><?php echo $sn++; ?></th>
                          <td><?php echo $namaProduk; ?></td>
                          <td>Rp. <?php echo number_format($harga,0,',','.'); ?></td>
                          <td>
                            <?php 
                              if($namaGambar!=""){
                                ?>
                                  <img src="<?php echo SITEURL; ?>images/product/<?php echo $namaGambar; ?>" alt="<?php echo $namaGambar; ?>" width="100px">
                                <?php
                              } else {
                                echo "<div class='text-muted'>Belum ada Gambar</div>";
                              }
                                ?>
                          </td>
                          <td><?php echo $deskripsi; ?></td>
                          <td><?php echo $featured; ?></td>
                          <td><?php echo $active; ?></td>   
                          <td><?php echo $satuan; ?></td>
                          <td><?php echo $stok; ?></td>                     
                          <td>
                            <a class="btn btn-success btn-sm mb-3" href="<?php echo SITEURL; ?>admin/update-product.php?id=<?php echo $id; ?>" role="button">Update Produk</a>
                            <a class="btn btn-danger btn-sm mb-3" href="<?php echo SITEURL; ?>admin/delete-product.php?id=<?php echo $id; ?>&namaGambar=<?php echo $namaGambar; ?>" role="button">Hapus Produk</a>
                          </td>
                        </tr>
                      </tbody>
                      <?php
                    }
                    } else {
                      ?>

                      <tr>
                        <td colspan="6">
                          <div class="text-muted">
                            Belum ada Produk yang ditambahkan
                          </div>
                        </td>
                      </tr>

                      <?php
                  }
                ?>
              </thead>
            </table>
      </div>
    </div>
    <!-- Akhir Konten -->

<?php include('partials/footer.php'); ?>