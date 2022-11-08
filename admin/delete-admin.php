<?php 

  include('../config/constants.php');

  //1. Mendapatkan id admin yang dihapus
  $id = $_GET['id'];

  //2. Membuat Sql query untuk menghapus
  $sql = "DELETE FROM tbl_admin WHERE id=$id";

  // Mengeksekusi Query SQL
  $res = mysqli_query($conn, $sql);

  //Mengecek apakah berhasil atau tidak
  if($res==TRUE) {
    $_SESSION['delete'] = "<div class='alert alert-success' role='alert'>
        Admin Berhasil Dihapus!
      </div>";

    header('location:'.SITEURL.'admin/manage-admin.php');
  } else {
    $_SESSION['delete'] = "<div class='alert alert-danger' role='alert'>
        Gagal Menghapus Admin!
      </div>";

    header('location:'.SITEURL.'admin/manage-admin.php');
  }

  //3. Menampilkan pesan

?>