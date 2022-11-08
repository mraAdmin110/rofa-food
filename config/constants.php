<?php 
  ob_start();
  //Start Session
  session_start();

  //Mendefinisikan Konstanta
  define('SITEURL', 'http://localhost/rofa-food/');
  define('LOCALHOST', 'localhost');
  define('DB_USERNAME', 'root');
  define('DB_PASSWORD', '');
  define('DB_NAME', 'rofa-food');

  $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error()); // Koneksi Database
  $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error()); //Selecting Database

?>