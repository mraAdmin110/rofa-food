<?php 
  include('../config/constants.php');

  if(isset($_GET['id']) AND isset($_GET['namaGambar'])){
    $id = $_GET['id'];
    $namaGambar = $_GET['namaGambar'];

    if($namaGambar != ""){
      $path = "../images/category/".$namaGambar;
      $remove = unlink($path);

      if($remove == FALSE) {
        $_SESSION['remove-image'] = "<div class='alert alert-danger' role='alert'>
            Gagal Menghapus Gambar!
            </div>";
        header('location:'.SITEURL.'admin/manage-category.php');
        die();
      }
    }

    $sql = "DELETE FROM tbl_kategori WHERE id=$id";

    $res = mysqli_query($conn, $sql);

    if($res==TRUE) {
      $_SESSION['delete'] = "<div class='alert alert-success' role='alert'>
          Berhasil Menghapus Kategori!
        </div>";

      header('location:'.SITEURL.'admin/manage-category.php');
    } else {
      $_SESSION['delete'] = "<div class='alert alert-danger' role='alert'>
          Gagal Menghapus Kategori!
        </div>";

      header('location:'.SITEURL.'admin/manage-category.php');
    }
  } else {
    header('location:'.SITEURL.'admin/manage-category.php');
  }
?>