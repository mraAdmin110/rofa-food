<?php 
  include('../config/constants.php');

  if(isset($_GET['id']) AND isset($_GET['gambar'])){
    $id = $_GET['id'];
    $gambar = $_GET['gambar'];

    if($gambar != "no-pic.png"){
      $path = "../images/foto-testimoni/".$gambar;
      $remove = unlink($path);

      if($remove == FALSE) {
        $_SESSION['remove-image'] = "<div class='alert alert-danger' role='alert'>
            Gagal Menghapus Gambar!
            </div>";
        header('location:'.SITEURL.'admin/manage-testimoni.php');
        die();
      }
    }

    $sql = "DELETE FROM tbl_testimoni WHERE id=$id";

    $res = mysqli_query($conn, $sql);

    if($res==TRUE) {
      $_SESSION['delete'] = "<div class='alert alert-success' role='alert'>
          Berhasil Menghapus testimoni!
        </div>";

      header('location:'.SITEURL.'admin/manage-testimoni.php');
    } else {
      $_SESSION['delete'] = "<div class='alert alert-danger' role='alert'>
          Gagal Menghapus testimoni!
        </div>";

      header('location:'.SITEURL.'admin/manage-testimoni.php');
    }
  } else {
    header('location:'.SITEURL.'admin/manage-testimoni.php');
  }
?>