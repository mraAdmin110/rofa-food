<?php include('partials-front/menu.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
  <title>Login - Rofa Food</title>
</head>
<body class="text-center">
    <div class="container login">
      <div class="d-flex justify-content-center h-100">
        <div class="card">
          <div class="card-header">
            <img src="images/logoRofa4.png" width="120" height="80" alt="">
            <h4 class=my-3>Silahkan Masuk</h4> 
            <?php 

                if(isset($_SESSION['login'])){
                  echo $_SESSION['login'];
                  unset($_SESSION['login']);
                }

                if(isset($_SESSION['no-login-message'])){
                  echo $_SESSION['no-login-message'];
                  unset($_SESSION['no-login-message']);
                }

                if(isset($_SESSION['add'])){
                  echo $_SESSION['add'];
                  unset($_SESSION['add']);
                }
            ?>
          </div>
          <div class="card-body">
            <form action="" method="POST">
              <div class="input-group form-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-user"></i></span>
                </div>
                <input type="text" name="username_pelanggan" class="form-control" placeholder="username">
              </div>
              <div class="input-group form-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-key"></i></span>
                </div>
                <input type="password" name="password_pelanggan" class="form-control" placeholder="password">
              </div>
              <div class="form-group">
                <input type="submit" name="submit" value="Masuk" class="btn btn-info">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

  <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>
</html>

<?php 

  if(isset($_POST['submit'])){
    echo $username_pelanggan = $_POST['username_pelanggan'];
    echo $password_pelanggan = md5($_POST['password_pelanggan']);

    $sql = "SELECT * FROM tbl_pelanggan WHERE username_pelanggan='$username_pelanggan' AND password_pelanggan='$password_pelanggan'";

    $res = mysqli_query($conn, $sql);

    $count = mysqli_num_rows($res);

    if($count == 1){
      $_SESSION['login'] = "<div class='alert alert-success' role='alert'>
        Berhasil Masuk!
      </div>";
      $_SESSION['user'] = $username_pelanggan; //untuk mengecek apakah user telah login atau tidak
      header("location:".SITEURL);
    } else {
      $_SESSION['login'] = "<div class='alert alert-danger' role='alert'>
        Username atau Password Tidak Cocok!
      </div>";
      header("location:".SITEURL.'login.php');
    }
  }

?>