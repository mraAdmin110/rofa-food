<?php include('partials-front/menu.php'); ?>

<div class="konten">
  <div class="container-fluid mt-3">
    <div class="hero">
      <div class="jumbotron jumbotron-fluid">
        <div class="container">
          <h1 class="display-4">Selamat Datang!</h1>
          <p class="lead">Rofa Food menyediakan berbagai macam produk makanan beku yang cocok untuk menemanimu.</p>
          <hr class="my-4">
          <p>Jadi, jangan biarkan teh dan kopimu sendirian, karena mereka layak ditemani.</p>
          <a class="btn btn-primary btn-lg btn-hero" href="#produk" role="button">Tertarik ?</a>
        </div>
      </div>
    </div>
    
    <div class="produk-search">
      <div class="container p-4">
        <h3 class="text-center mb-3">Cari Produk disini</h3>
        <form action="<?php echo SITEURL; ?>product-search.php" method="POST">
          <div class="input-group mb-3">
            <input type="search" name="search" class="form-control" placeholder="Cari Produk" aria-label="Cari Produk" aria-describedby="button-addon2" required>
            <div class="input-group-append">
              <input type="submit" name="submit" value="Cari" class="btn btn-primary btn-hero">
            </div>
          </div>
        </form>
      </div>
    </div>

    <div id="produk" class="produk">
      <div class="container mb-4">
        <h3 class="text-center mb-3">Daftar Produk Unggulan</h3>
        <div class="row row-cols-1 row-cols-md-4">
          <?php
            $sql2 = "SELECT * FROM tbl_produk WHERE active='Yes' AND featured='Yes' LIMIT 12";
            $res2 = mysqli_query($conn, $sql2);
            $count2 = mysqli_num_rows($res2);
            if ($count2 > 0) {
                while ($row2 = mysqli_fetch_assoc($res2)) {
                    $id = $row2['id'];
                    $namaProduk = $row2['namaProduk'];
                    $harga = $row2['harga'];
                    $namaGambar = $row2['namaGambar'];
                    $deskripsi = $row2['deskripsi'];
                    $stok = $row2['stok'];
          ?>
          <div class="col mb-4">
            <div class="card h-100">
              <?php
              if ($namaGambar == "") {
                echo "<div class='text-muted'>Gambar Tidak Tersedia</div>";
              } else {
              ?>
              <img src="<?php echo SITEURL; ?>images/product/<?php echo $namaGambar; ?>" class="card-img-top" alt="<?php echo $namaGambar; ?>">
              <?php
                }
              ?>
              <div class="card-body">
                <h5 class="card-title"><?php echo $namaProduk; ?></h5>
                <p class="card-text text-muted">Rp. <?php echo number_format($harga,0,',','.'); ?></p>
                <p class="card-text"><?php echo $deskripsi; ?></p>
                <p class="card-text text-muted">Stok Tersedia <?php echo $stok; ?></p>
              </div>
              <div class="card-footer">
                <a href="<?php echo SITEURL; ?>beli.php?id=<?php echo $id; ?>" class="btn btn-outline-success text-success">Keranjang</a>
              </div>
            </div>
          </div>
          <?php
            }
          } else {
              echo "<div class='text-muted'>Produk Tidak Tersedia</div>";
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include('partials-front/footer.php'); ?>