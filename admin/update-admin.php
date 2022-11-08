<?php include('partials/menu.php'); ?>

  <!-- Awal Add Admin Section -->
  <div class="container mt-3 p-5">
    <h1 class="h2 mb-3">Form Update Admin</h1>
    <br/>
    <?php 
      // 1. Mengambil Id dari admin yang dipilih
      $id = $_GET['id'];

      // 2. Membuat Sql query
      $sql = "SELECT * FROM tbl_admin WHERE id=$id";

      //Mengeksekusi Query
      $res = mysqli_query($conn, $sql);

      if($res==TRUE) {
        $count = mysqli_num_rows($res);

        if($count == 1) {
          $row = mysqli_fetch_assoc($res);

          $nama = $row['nama'];
          $username = $row['username'];
        } else {
          header('location:'.SITEURL.'admin/manage-admin.php');
        }
      }
    ?>
    <br>
    <form class="col-sm-6" action="" method="POST">
      <div class="form-group">
        <label for="exampleInputNama">Id</label>
        <input class="form-control" name="id" type="text" placeholder="Readonly input here..." readonly value="<?php echo $id ?>">
      </div>
      <div class="form-group">
        <label for="exampleInputNama">Nama</label>
        <input type="text" class="form-control" name="nama" id="exampleInputNama" aria-describedby="emailHelp" placeholder="Masukkan Nama" value="<?php echo $nama ?>">
      </div>
      <div class="form-group">
        <label for="exampleInputUsername">Username</label>
        <input type="text" class="form-control" name="username" id="exampleInputUsername" placeholder="Masukkan Username" value="<?php echo $username ?>">
      </div>
      <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
    </form>
  </div>
  <!-- Akhir Add Admin Section -->

  <?php 
    if(isset($_POST['submit'])){
      $id = $_POST['id'];
      $nama = $_POST['nama'];
      $username = $_POST['username'];

      $sql = "UPDATE tbl_admin SET 
        nama = '$nama',
        username = '$username'
        WHERE id='$id'
      ";

      $res = mysqli_query($conn, $sql);

      if($res == TRUE) {
      //Membuat variabel session untuk menampilkan pesan
          $_SESSION['update'] = "<div class='alert alert-success' role='alert'>
            Admin Berhasil Diupdate!
          </div>";
          header("location:".SITEURL.'admin/manage-admin.php');
      }else {
          $_SESSION['update'] = "<div class='alert alert-danger' role='alert'>
            Admin Gagal Diupdate!
          </div>";
          header("location:".SITEURL.'admin/add-admin.php');
      }
    }
  ?>

<?php include('partials/footer.php'); ?>