<?php include('partials/menu.php'); ?>

  <!-- Awal Konten -->
    <div class="konten">
      <div class="container mt-3 p-5">
        <h1 class="h2 mb-3">Pengaturan Testimoni</h1>
        <?php 
          if(isset($_SESSION['remove-image'])){
            echo $_SESSION['remove-image'];
            unset($_SESSION['remove-image']);
          }
          
          if(isset($_SESSION['delete'])){
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
          }
        ?>
        <div class="table-responsive">
          <table class="table table-bordered table-hover">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Gambar</th>
                  <th scope="col">Feedback</th>
                  <th scope="col">Aksi</th>
                </tr>
                <?php 
                  $sql = "SELECT * FROM tbl_testimoni";

                  $res = mysqli_query($conn, $sql);

                  $count = mysqli_num_rows($res);
                  $sn = 1;
                  if($count>0){
                    while($row=mysqli_fetch_assoc($res)){
                      $id = $row['id'];
                      $nama = $row['nama'];
                      $gambar = $row['gambar'];
                      $feedback = $row['feedback'];
                      ?>
                <tbody>
                  <tr>
                      <th scope="row"><?php echo $sn++; ?></th>
                      <td><?php echo $nama; ?></td>
                      <td><img src="<?php echo SITEURL; ?>images/foto-testimoni/<?php echo $gambar; ?>" alt="<?php echo $gambar; ?>" width="100px"></td>
                      <td><?php echo $feedback; ?></td>
                      <td>
                          <a class="btn btn-danger btn-sm mb-3" href="<?php echo SITEURL; ?>admin/delete-testimoni.php?id=<?php echo $id; ?>&gambar=<?php echo $gambar; ?>" role="button">Hapus Testimoni</a>
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
                          Belum ada Testimoni yang ditambahkan
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