<?php include('partials/menu.php'); ?>

  <!-- Awal Konten -->
    <div class="konten">
      <div class="container mt-1 p-5">
        <h1 class="h2 mb-3">Pengaturan Admin</h1>
        <?php 
          if(isset($_SESSION['add'])){
            echo $_SESSION['add'];
            unset($_SESSION['add']);
          }

          if(isset($_SESSION['delete'])){
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
          }

          if(isset($_SESSION['update'])){
            echo $_SESSION['update'];
            unset($_SESSION['update']);
          }

          if(isset($_SESSION['user-not-found'])){
            echo $_SESSION['user-not-found'];
            unset($_SESSION['user-not-found']);
          }

          if(isset($_SESSION['pwd-not-match'])){
            echo $_SESSION['pwd-not-match'];
            unset($_SESSION['pwd-not-match']);
          }

          if(isset($_SESSION['ubah-password'])){
            echo $_SESSION['ubah-password'];
            unset($_SESSION['ubah-password']);
          }
        ?>
        <br>
        <a class="btn btn-primary btn-md mb-3" href="add-admin.php" role="button">Tambah Admin</a>
        <div class="table-responsive">
          <table class="table table-bordered table-hover">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Username</th>
                  <th scope="col">Aksi</th>
                </tr>

                <?php 
                  $sql = "SELECT * FROM tbl_admin";
                  $res = mysqli_query($conn, $sql);

                  if($sql == TRUE ){
                    $count = mysqli_num_rows($res);
                    $sn = 1;
                    if($count > 0) {
                      while($rows=mysqli_fetch_assoc($res)){
                        $id = $rows['id'];
                        $nama = $rows['nama'];
                        $username = $rows['username'];
                        ?>

                        <tbody>
                          <tr>
                              <th scope="row"><?php echo $sn++; ?></th>
                                <td><?php echo $nama; ?></td>
                                <td><?php echo $username; ?></td>
                                <td>
                                  <a class="btn btn-info btn-sm mb-3" href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" role="button">Ubah Password</a>
                                  <a class="btn btn-success btn-sm mb-3" href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" role="button">Update Admin</a>
                                  <a class="btn btn-danger btn-sm mb-3" href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" role="button">Hapus Admin</a>
                                </td>
                          </tr>
                        </tbody>

                        <?php
                      }
                    } else {

                    }
                  }
                ?>
              </thead>
              
            </table>
        </div>
      </div>
    </div>
  <!-- Akhir Konten -->

<?php include('partials/footer.php'); ?>