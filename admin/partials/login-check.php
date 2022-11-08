<?php 

  //Authorisasi
  //Mengecek apakah user sudah login atau belum
  if(!isset($_SESSION['user'])) //Jika user session belum di set
  {
    //User belum log in
      $_SESSION['no-login-message'] = "<div class='alert alert-danger' role='alert'>
        Harap Login Terlebih dahulu untuk Mengakses Admin Panel!
      </div>";
      header("location:".SITEURL.'admin/login.php');
  }

?>