<?php include('partials-front/menu.php'); ?>

<div class="sukses">
  <div class="container mt-4">
    <div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-tittle">Daftar Pelanggan</h3>
					</div>
					<div class="panel-body">
						<form method="post" class="form-horizontal">
							<div class="form-group">
								<label class="control-label col-md-3">Username</label>
								<div class="col-md-7">
									<input type="text" class="form-control" name="username_pelanggan" required>
								</div>
							</div>
              <div class="form-group">
								<label class="control-label col-md-3">Password</label>
								<div class="col-md-7">
									<input type="text" class="form-control" name="password_pelanggan" required>
								</div>
							</div>
              <div class="form-group">
								<label class="control-label col-md-3">Nama</label>
								<div class="col-md-7">
									<input type="text" class="form-control" name="nama_pelanggan" required>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Email</label>
								<div class="col-md-7">
									<input type="email" class="form-control" name="email_pelanggan" required>
								</div>
							</div>
              <div class="form-group">
                <label class="control-label col-md-3">Telp</label>
                <div class="col-md-7">
                  <input type="text" class="form-control" name="telepon_pelanggan" required>
                </div>
              </div>
							<div class="form-group">
								<label class="control-label col-md-3">Alamat</label>
								<div class="col-md-7">
									<textarea class="form-control" name="alamat_pelanggan" required></textarea>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-7 col-md-offset-3">
									<button class="btn btn-primary" name="submit">Daftar</button>
								</div>
							</div>
						</form>
            <?php 
              if (isset($_POST['submit'])) {
                //echo "Button Klik";

                //1. Mengambil data dari form
                $username_pelanggan = $_POST['username_pelanggan'];
                $password_pelanggan = md5($_POST['password_pelanggan']);
                $nama_pelanggan = $_POST['nama_pelanggan'];
                $email_pelanggan = $_POST['email_pelanggan'];
                $telepon_pelanggan = $_POST['telepon_pelanggan'];
                $alamat_pelanggan = $_POST['alamat_pelanggan'];

                //cek apakah email telah terpakai
                $ambil=$conn->query("SELECT * FROM tbl_pelanggan WHERE email_pelanggan='$email_pelanggan'");
                $emailsama=$ambil->num_rows;
                if ($emailsama==1) 
                {
                  $_SESSION['add'] = "<div class='alert alert-danger' role='alert'>
                    Pendaftaran Gagal, Email sudah terpakai!
                  </div>";
                  header("location:".SITEURL.'daftar.php');
                }
                else
                {
                  //query insert
                  $conn->query("INSERT INTO tbl_pelanggan 
                    (username_pelanggan,password_pelanggan,nama_pelanggan,email_pelanggan,telepon_pelanggan,alamat_pelanggan)
                    VALUES('$username_pelanggan','$password_pelanggan','$nama_pelanggan','$email_pelanggan','$telepon_pelanggan','$alamat_pelanggan')");

                  $_SESSION['add'] = "<div class='alert alert-success' role='alert'>
                    Pendaftaran Sukses, Silahkan Login
                  </div>";
                  header("location:".SITEURL.'login.php');
                }
              }
            ?>
					</div>
				</div>
			</div>
		</div>
  </div>
</div>

<?php include('partials-front/footer.php'); ?>