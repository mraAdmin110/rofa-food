<?php include('partials/menu.php'); ?>

  <!-- Awal Konten -->
    <div class="konten">
      <div class="container mt-3 p-5">
        <h1 class="h2 mb-3">Pengaturan Kategori</h1>
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

          if(isset($_SESSION['no-category-found'])){
            echo $_SESSION['no-category-found'];
            unset($_SESSION['no-category-found']);
          }

          if(isset($_SESSION['update'])){
            echo $_SESSION['update'];
            unset($_SESSION['update']);
          }

          if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
          }

          if(isset($_SESSION['failed-remove'])){
            echo $_SESSION['failed-remove'];
            unset($_SESSION['failed-remove']);
          }
        ?>
        <a class="btn btn-primary btn-md mb-3" href="<?php echo SITEURL; ?>admin/add-category.php" role="button">Tambah Kategori</a>
        <div class="table-responsive mb-3">
          <table class="table table-bordered table-hover">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">Id</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Gambar</th>
                  <th scope="col">Fitur</th>
                  <th scope="col">Aktif</th>
                  <th scope="col">Aksi</th>
                </tr>

                <?php 
                  $sql = "SELECT * FROM tbl_kategori";

                  $res = mysqli_query($conn, $sql);

                  $count = mysqli_num_rows($res);
                  $sn = 1;
                  if($count>0){
                    while($row=mysqli_fetch_assoc($res)){
                      $id = $row['id'];
                      $namaKategori = $row['namaKategori'];
                      $namaGambar = $row['namaGambar'];
                      $featured = $row['featured'];
                      $active = $row['active'];

                      ?>

                        <tbody>
                          <tr>
                            <th scope="row"><?php echo $sn++; ?></th>
                            <td><?php echo $namaKategori; ?></td>

                            <td>
                              <?php 
                                if($namaGambar!=""){
                                  ?>
                                  <img src="<?php echo SITEURL; ?>images/category/<?php echo $namaGambar; ?>" alt="<?php echo $namaGambar; ?>" width="100px">
                                  <?php
                                } else {
                                  echo "<div class='text-muted'>
                                        Belum ada Gambar
                                      </div> ";
                                }
                              ?>
                            </td>
                            <td><?php echo $featured; ?></td>
                            <td><?php echo $active; ?></td>
                            <td>
                              <a class="btn btn-success btn-sm mb-3" href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" role="button">Update Kategori</a>
                              <a class="btn btn-danger btn-sm mb-3" href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&namaGambar=<?php echo $namaGambar; ?>" role="button">Hapus Kategori</a>
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
                          Belum ada kategori yang ditambahkan
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