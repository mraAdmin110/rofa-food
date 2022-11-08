<?php 
  include('../config/constants.php'); 
  include('login-check.php');   
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/admin.css">

    <title>Rofa Food Admin - Dashboard</title>
  </head>
  <body>
    <!-- Awal Navigasi -->
      <div class="navigasi">
        <nav class="navbar navbar-expand-lg navbar-dark">
          <a class="navbar-brand" href="#">Rofa Food Admin</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ml-auto">
              <a class="nav-link active" href="index.php">Dashboard <span class="sr-only">(current)</span></a>
              <a class="nav-link" href="manage-admin.php">Admin</a>
              <a class="nav-link" href="manage-category.php">Kategori</a>
              <a class="nav-link" href="manage-product.php">Produk</a>
              <a class="nav-link" href="manage-order.php">Pesanan</a>
              <a class="nav-link" href="manage-testimoni.php">Testimoni</a>
              <a class="nav-link" href="logout.php">Keluar</a>
            </div>
          </div>
        </nav>
      </div>
    <!-- Akhir Navigasi -->