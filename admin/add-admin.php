<?php include('partials/menu.php'); ?>

  <!-- Awal Add Admin Section -->
  <div class="container mt-3 p-5">
    <h1 class="h2 mb-3">Form Tambah Admin</h1>
    <br/>
    <?php 
          if(isset($_SESSION['add'])){
            echo $_SESSION['add'];
            unset($_SESSION['add']);
          }
    ?>
    <br>
    <form class="col-sm-6" action="" method="POST">
      <div class="form-group">
        <label for="exampleInputNama">Nama</label>
        <input type="text" class="form-control" name="nama" id="exampleInputNama" aria-describedby="emailHelp" placeholder="Masukkan Nama">
      </div>
      <div class="form-group">
        <label for="exampleInputUsername">Username</label>
        <input type="text" class="form-control" name="username" id="exampleInputUsername" placeholder="Masukkan Username">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" name="password" id="exampleInputPassword1">
      </div>
      
      <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
    </form>
  </div>
  <!-- Akhir Add Admin Section -->

<?php include('partials/footer.php'); ?>

<?php 
  // Proses Input dari Form dan Menyimpan ke Database

  // Mengecek Apakah Submit Button di klik atau tidak
  if (isset($_POST['submit'])) {
    //echo "Button Klik";

    //1. Mengambil data dari form
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); //md5 untuk mengenkripsi password

    //2. Menyimpan data ke database
    $sql = "INSERT INTO tbl_admin SET
        nama = '$nama',
        username = '$username',
        password = '$password'
    ";

    //Mengeksekusi query
    $res = mysqli_query($conn, $sql) or die(mysqli_error());

    //Mengecek apakah data tersimpan ke dalam database
    if($res == TRUE) {
      //Membuat variabel session untuk menampilkan pesan
      $_SESSION['add'] = "<div class='alert alert-success' role='alert'>
        Admin Berhasil Ditambah!
      </div>";
      header("location:".SITEURL.'admin/manage-admin.php');
    }else {
      $_SESSION['add'] = "<div class='alert alert-danger' role='alert'>
        Admin Gagal Ditambah!
      </div>";
      header("location:".SITEURL.'admin/add-admin.php');
    }
  } 

?>