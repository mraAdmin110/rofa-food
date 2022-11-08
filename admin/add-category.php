<?php include('partials/menu.php'); ?>

  <!-- Awal Add Admin Section -->
  <div class="container mt-3 p-5">
    <h1 class="h2 mb-3">Form Tambah Kategori</h1>
    <br/>
    <?php 
          if(isset($_SESSION['add'])){
            echo $_SESSION['add'];
            unset($_SESSION['add']);
          }

          if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
          }
    ?>
    <br>
    <form class="col-sm-6" action="" method="POST" enctype="multipart/form-data">
      <div class="form-group">
        <label for="exampleInputKategori">Nama Kategori</label>
        <input type="text" class="form-control" name="namaKategori" id="exampleInputKategori" aria-describedby="emailHelp" placeholder="Masukkan Kategori">
      </div>
      <div class="mb-2">
        <input type="file" name="namaGambar"  id="customFile">
        <!-- <label for="customFile">Choose File</label> -->
      </div>
      <fieldset class="form-group row">
        <legend class="col-form-label col-sm-1 float-sm-left pt-0">Fitur</legend>
        <div class="col-sm">
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="featured" id="gridRadios1" value="Yes">
            <label class="form-check-label" for="gridRadios1">
              Yes
            </label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="featured" id="gridRadios2" value="No">
            <label class="form-check-label" for="gridRadios2">
              No
            </label>
          </div>
        </div>
      </fieldset>
      <fieldset class="form-group row">
        <legend class="col-form-label col-sm-1 float-sm-left pt-0">Aktif</legend>
        <div class="col-sm">
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="active" id="gridRadios1" value="Yes">
            <label class="form-check-label" for="gridRadios1">
              Yes
            </label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="active" id="gridRadios2" value="No">
            <label class="form-check-label" for="gridRadios2">
              No
            </label>
          </div>
        </div>
      </fieldset> 
      <button type="submit" name="submit" class="btn btn-primary">Simpan</button>

      <?php 
        if(isset($_POST['submit'])){
          $namaKategori = $_POST['namaKategori'];

          if(isset($_POST['featured'])){
            $featured = $_POST['featured'];
          } else {
            $featured = "No";
          }

          if(isset($_POST['active'])){
            $active = $_POST['active'];
          } else {
            $active = "No";
          }

          // print_r($_FILES['namaGambar']);

          // die();

          if(isset($_FILES['namaGambar']['name'])){
            $namaGambar = $_FILES['namaGambar']['name'];
            
            if($namaGambar != "") {
              $tmp = explode('.', $namaGambar);
              $ext = end($tmp);

              $namaGambar = "Kategori_".rand(000,999).'.'.$ext;

              $source_path = $_FILES['namaGambar']['tmp_name'];
              $destination_path = "../images/category/".$namaGambar;

              $upload = move_uploaded_file($source_path, $destination_path);

              if($upload == FALSE) {
                $_SESSION['upload'] = "<div class='alert alert-error' role='alert'>
                Gagal Mengupload Gambar!
                </div>";
                header("location:".SITEURL.'admin/add-category.php');
                die();
                }
              }
          } else {
            $namaGambar= "";
          }

          $sql = "INSERT INTO tbl_kategori SET
            namaKategori = '$namaKategori',
            namaGambar = '$namaGambar',
            featured = '$featured',
            active = '$active'
          ";

          $res = mysqli_query($conn, $sql);

          if($res == TRUE) {
            $_SESSION['add'] = "<div class='alert alert-success' role='alert'>
            Berhasil Menambah Kategori!
            </div>";
            header("location:".SITEURL.'admin/manage-category.php');
          } else {
            $_SESSION['add'] = "<div class='alert alert-danger' role='alert'>
            Gagal Menambah Kategori!
            </div>";
            header("location:".SITEURL.'admin/add-category.php');
          }
        }
      ?>
    </form>
  </div>
  <!-- Akhir Add Admin Section -->

<?php include('partials/footer.php'); ?>
