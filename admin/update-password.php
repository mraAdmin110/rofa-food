<?php include('partials/menu.php'); ?>

  <!-- Awal Add Admin Section -->
  <div class="container mt-3 p-5">
    <h1 class="h2 mb-1">Ubah Password</h1>
    <?php 
      if(isset($_GET['id'])) {
        $id = $_GET['id'];
        
      }


    ?>
    <br>
    <form class="col-sm-6" action="" method="POST">
      <div class="form-group">
        <label for="exampleInputNama">Id</label>
        <input class="form-control" name="id" type="text" placeholder="Readonly input here..." readonly value="<?php echo $id; ?>">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Password Lama</label>
        <input type="password" class="form-control" name="passwordLama" id="exampleInputPassword1">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Password Baru</label>
        <input type="password" class="form-control" name="passwordBaru" id="exampleInputPassword1">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Konfirmasi Password</label>
        <input type="password" class="form-control" name="konfirmasiPassword" id="exampleInputPassword1">
      </div>
      
      <button type="submit" name="submit" class="btn btn-primary">Ubah Password</button>
    </form>
  </div>
  <!-- Akhir Add Admin Section -->

  <?php 
    if(isset($_POST['submit'])) {

      $id = $_POST['id'];
      $passwordLama = md5($_POST['passwordLama']);
      $passwordBaru = md5($_POST['passwordBaru']);
      $konfirmasiPassword = md5($_POST['konfirmasiPassword']);

      $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$passwordLama'";

      $res = mysqli_query($conn, $sql);

      if($res == TRUE ){
        $count = mysqli_num_rows($res);

        if($count == 1) {
          if($passwordBaru == $konfirmasiPassword) {
            $sql2 = "UPDATE tbl_admin SET password='$passwordBaru' WHERE id=$id";

            $res2 = mysqli_query($conn, $sql2);

            if($res2 == TRUE) {
              $_SESSION['ubah-password'] = "<div class='alert alert-success' role='alert'>
              Berhasil Mengganti Password!
              </div>";
              header("location:".SITEURL.'admin/manage-admin.php');
            } else {
              $_SESSION['ubah-password'] = "<div class='alert alert-danger' role='alert'>
              Gagal Mengganti Password!
              </div>";
              header("location:".SITEURL.'admin/manage-admin.php');
            }

          } else {
            $_SESSION['pwd-not-match'] = "<div class='alert alert-danger' role='alert'>
            Password tidak cocok!
            </div>";
            header("location:".SITEURL.'admin/manage-admin.php');
          }
        } else {
          $_SESSION['user-not-found'] = "<div class='alert alert-danger' role='alert'>
            Admin tidak ditemukan!
          </div>";
          header("location:".SITEURL.'admin/manage-admin.php');
        }
      }
    }
  ?>

<?php include('partials/footer.php'); ?>