<?php include('partials-front/menu.php'); ?>

<div class="testimoni">
  <div class="container">
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
    <div class="row">
      <div class="col">
        <h3 class="my-3">Testimoni</h3>
        <div class="row row-cols-1 row-cols-md-2">
          <?php
            $sql2 = "SELECT * FROM tbl_testimoni LIMIT 8";
            $res2 = mysqli_query($conn, $sql2);
            $count2 = mysqli_num_rows($res2);
            if ($count2 > 0) {
                while ($row2 = mysqli_fetch_assoc($res2)) {
                    $id = $row2['id'];
                    $nama = $row2['nama'];
                    $gambar = $row2['gambar'];
                    $feedback = $row2['feedback'];
          ?>
          <div class="card mx-2 mb-3" style="max-width: 540px;">
            <div class="row no-gutters">
              <div class="col-md-4">
                <img src="<?php echo SITEURL; ?>images/foto-testimoni/<?php echo $gambar; ?>" class="card-img-top" alt="<?php echo $gambar; ?>">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title"><?php echo $nama; ?></h5>
                  <p class="card-text"><?php echo $feedback; ?></p>
                </div>
              </div>
            </div>
          </div>
          <?php
            }
          } else {
              echo "<div class='text-muted'>Testimoni Tidak Tersedia</div>";
          }
          ?>
        </div>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col">
        <h3 class="my-3">Form Testimoni</h3>
        <form action="" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label for="exampleInputName">Nama</label>
            <input type="text" name="nama" class="form-control" id="exampleInputName" aria-describedby="emailHelp" required>
          </div>
          <div class="form-group">
            <label for="exampleFormControlFile1">Masukkan Foto (Opsional)</label>
            <input type="file" name="gambar" class="form-control-file" id="exampleFormControlFile1">
          </div>
          <div class="form-group">
            <label for="exampleFormControlTextarea1">Feedback</label>
            <textarea name="feedback" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Masukkan Feedback" required></textarea>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
          </div>
          <?php 
            if(isset($_POST['submit'])){
              $nama = $_POST['nama'];
              $feedback = $_POST['feedback'];
  
              if(isset($_FILES['gambar']['name'])){
                $gambar = $_FILES['gambar']['name'];
                
                if($gambar != "") {
                  $tmp = explode('.', $gambar);
                  $ext = end($tmp);
  
                  $gambar = "foto_testimoni".rand(000,999).'.'.$ext;
  
                  $source_path = $_FILES['gambar']['tmp_name'];
                  $destination_path = "images/foto-testimoni/".$gambar;
  
                  $upload = move_uploaded_file($source_path, $destination_path);
  
                  if($upload == FALSE) {
                    $_SESSION['upload'] = "<div class='alert alert-danger' role='alert'>
                    Gagal Mengupload Gambar!
                    </div>";
                    header("location:".SITEURL.'testimoni.php');
                    die();
                    }
                  } else {
                    $gambar="no-pic.png";
                  }
              } else {
                $gambar= "";
              }
  
              $sql = "INSERT INTO tbl_testimoni SET
                nama = '$nama',
                gambar = '$gambar',
                feedback = '$feedback'
              ";
  
              $res = mysqli_query($conn, $sql);
  
              if($res == TRUE) {
                $_SESSION['add'] = "<div class='alert alert-success' role='alert'>
                Berhasil Menambah Testimoni!
                </div>";
                header("location:".SITEURL.'testimoni.php');
              } else {
                $_SESSION['add'] = "<div class='alert alert-danger' role='alert'>
                Gagal Menambah Testimoni!
                </div>";
                header("location:".SITEURL.'testimoni.php');
              }
            }
          ?>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include('partials-front/footer.php'); ?>