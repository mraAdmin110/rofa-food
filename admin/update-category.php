<?php include('partials/menu.php'); ?>

<div class="container mt-3 p-5">
    <h1 class="h2 mb-3">Form Update Kategori</h1>
    <br><br>

        <?php

        if (isset($_GET['id'])) {

            $id = $_GET['id'];

            $sql = "SELECT * FROM tbl_kategori WHERE id=$id";

            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);

            if ($count == 1) {

                $row = mysqli_fetch_assoc($res);
                $namaKategori = $row['namaKategori'];
                $current_image = $row['namaGambar'];
                $featured = $row['featured'];
                $active = $row['active'];
            } else {
                $_SESSION['no-category-found'] = "<div class='alert alert-danger' role='alert'>
                  Kategori tidak ditemukan!
                </div>";
                header('location:'.SITEURL.'admin/manage-category.php');
            }
        } else {
            header('location: '.SITEURL.'admin/manage-category.php');
        }

        ?>

        <form action="" method="POST" enctype="multipart/form-data">
          <div class="table-responsive">
            <table class="table table-borderless table-sm">
                <tr>
                    <td>Nama Kategori: </td>
                    <td>
                        <input type="text" name="namaKategori" value="<?php echo $namaKategori; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Gambar Terbaru: </td>
                    <td>
                        <?php
                        if ($current_image != "") {
                        ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px">
                        <?php
                        } else {
                            echo "<div class='text-muted'>Image belum ditambahkan.</div>";
                        }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Ubah Gambar: </td>
                    <td>
                        <input type="file" name="namaGambar">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if ($featured == "Yes") {
                                    echo "checked";
                                } ?> type="radio" name="featured" value="Yes"> Yes

                        <input <?php if ($featured == "No") {
                                    echo "checked";
                                } ?> type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if ($active == "Yes") {
                                    echo "checked";
                                } ?> type="radio" name="active" value="Yes"> Yes
                        <input <?php if ($active == "No") {
                                    echo "checked";
                                } ?> type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Kategori" class="btn btn-primary">
                    </td>
                </tr>
            </table>
          </div>

        </form>

        <?php 
          if(isset($_POST['submit'])){
            $id = $_POST['id'];
            $namaKategori = $_POST['namaKategori'];
            $current_image = $_POST['current_image'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            if(isset($_FILES['namaGambar']['name'])){
              $namaGambar = $_FILES['namaGambar']['name'];

              if($namaGambar != ""){
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
                  header("location:".SITEURL.'admin/manage-category.php');
                  die();
                }

                if($current_image != ""){
                  $remove_path = "../images/category/".$current_image;
                  $remove = unlink($remove_path);

                  if($remove == FALSE){
                    $_SESSION['failed-remove'] = "<div class='alert alert-error' role='alert'>
                    Gagal Menghapus Gambar!
                    </div>";
                    header("location:".SITEURL.'admin/manage-category.php');
                    die();
                  }
                }
                
              } else {
                $namaGambar = $current_image;
              }
            } else {
              $namaGambar = $current_image;
            }

            $sql2 = "UPDATE tbl_kategori SET 
              namaKategori = '$namaKategori',
              namaGambar = '$namaGambar',
              featured = '$featured',
              active = '$active'
              WHERE id=$id
            ";

            $res2 = mysqli_query($conn, $sql2);

            if($res2 == TRUE) {
              $_SESSION['update'] = "<div class='alert alert-success'>Berhasil Update Kategori.</div>";
              header('location:'.SITEURL.'admin/manage-category.php');
            } else {
              $_SESSION['update'] = "<div class='alert alert-error'>Gagal Update Kategori.</div>";
              header('location:'.SITEURL.'admin/manage-category.php');
            }
          }
        ?>
  </div>

<?php include('partials/footer.php'); ?>